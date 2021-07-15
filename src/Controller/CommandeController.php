<?php

namespace App\Controller;

use App\Classe\Panier;
use App\Entity\Commande;
use App\Entity\DetailCommande;
use App\Entity\Voyage;
use App\Form\CommandeRdvType;
use App\Form\CommandeType;
use App\Form\RdvCommandeModifType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }



    /**
     * @Route("/commande", name="commande")
     */
    public function index(Panier $panier, Request $request): Response
    {
        $formCommande=$this->createForm(CommandeType::class, null, [
            'user'=>$this->getUser()    //config du 'user' dans le OrderType buildForm et configureOptions
        ]);


        return $this->render('commande/index.html.twig', [
            'formCommande'=>$formCommande->createView(),
            'panier'=>$panier->getAll()
        ]);
    }





    /**
     * @Route("/commande/recapitulatif", name="commande_recap" , methods={"POST"})
     */
    public function add(Panier $panier, Request $request /*, Voyage $voyage*/): Response
    {


        //$listeComVoy=$this->entityManager->getRepository(Commande::class)->findVoyageByCommande();


        $formCommande=$this->createForm(CommandeType::class, null, [
            'user'=>$this->getUser()    //config du 'user' dans le OrderType buildForm et configureOptions
        ]);

        $formCommande->handleRequest($request);

        $notification = null;


        if($formCommande->isSubmitted() && $formCommande->isValid()) {

            $date=new \DateTime();

            $nbrePersPlus12 = $formCommande->get('NbPersPlus12')->getData();
            $nbrePersMoins12 = $formCommande->get('NbPersMoins12')->getData();


            $commande=new Commande();

            $ref=$date->format('dmY').'-'.uniqid();

            $commande->setReference($ref);
            $commande->setDateCreation($date);
            $commande->setClient($this->getUser());
            $commande->setEtat(0);

            foreach ($panier->getAll() as $voy)
            {
                $commande->setVoyage($voy["voyageNom"]);


                $detailCommande=new DetailCommande();

                $detailCommande->setCommande($commande);
                $detailCommande->setVoyageNom($voy["voyageNom"]->getNom());
                $detailCommande->setQuantite($voy["quantite"]);
                $detailCommande->setPrix($voy['voyageNom']->getTarif());
                $detailCommande->setReductionMoins12($voy['voyageNom']->getTarif()-$voy['voyageNom']->getTarifMoins12());
                $detailCommande->setNbPersPlus12($nbrePersPlus12);
                $detailCommande->setNbPersMoins12($nbrePersMoins12);
                $detailCommande->setTotal($detailCommande->getPrix()*$detailCommande->getNbPersPlus12()+($detailCommande->getPrix()-$detailCommande->getReductionMoins12())*$detailCommande->getNbPersMoins12());

                $this->entityManager->persist($detailCommande);


            }


            $nbPlaces=$nbrePersPlus12+$nbrePersMoins12;



            $commande->getVoyage()->setNbPlace($commande->getVoyage()->getNbPlace() - $nbPlaces);


             if ($commande->getVoyage()->getNbPlace() <= 0) {
                    $commande->setEtat(3);

                    $notification = " Le séjour que vous voulez réservé est complet. Nous sommes au regret de vous 
                    annoncé que vous ne pourrez pas le réserver";

                 $commande->getVoyage()->setNbPlace($commande->getVoyage()->getNbPlace()+$nbPlaces);

                }

            $this->entityManager->flush();


            return $this->render('commande/add.html.twig',[
                'panier'=>$panier->getAll(),
                'reference'=>$commande->getReference(),
                'nbrePersPlus12'=>$nbrePersPlus12,
                'nbrePersMoins12'=>$nbrePersPlus12,
                "notification"=>$notification
                            ]);
        }


            return $this->redirectToRoute('panier');

    }



    /**
     * @Route("/commande/commandeRdv", name="commande_rdv")
     */
    public function prendreRdv(Panier $panier, Request $request): Response
    {

        $notification="";



        $formCommandeRdv=$this->createForm(CommandeRdvType::class, null, [
            'user'=>$this->getUser()    //config du 'user' dans le OrderType buildForm et configureOptions
        ]);

        $formCommandeRdv->handleRequest($request);

        $commande=$this->entityManager->getRepository(Commande::class)->findOneByClient($this->getUser());



        if($formCommandeRdv->isSubmitted() && $formCommandeRdv->isValid()) {

            $date=new \DateTime();

            $heureRdv = $formCommandeRdv->get('heureRdv')->getData();
            $dateRdv = $formCommandeRdv->get('dateRdv')->getData();
            $rdvPresentiel = $formCommandeRdv->get('rdvPresentiel')->getData();


            $commande->setHeureRDV($heureRdv);
            $commande->setDateRDV($dateRdv);
            $commande->setRdvPresentiel($rdvPresentiel);
            $commande->setEtat(1);


            $this->entityManager->flush();


            $notification = " Vous avez pris un rendez-vous pour réserver votre demande à la date et à l'heure de votre choix.
            Veuillez apporter les pièces d'identités et les justificatifs d'age des personnes que vous avez 
            mentionné dans la réservation. Nous les enregistreront par la suite dans notre base de donnée et
            ils seront inscrit pour le voyage considéré";

        }

        return $this->render('commande/pageRdv.html.twig',[
            'panier'=>$panier->getAll(),
            "notification"=>$notification,
            'formCommandeRdv'=>$formCommandeRdv->createView(),

        ]);

    }



    /**
     * @Route("/compte/modifier-rdvCommande/{id}", name="update_rdvCommande")
     */
    public function updateRdvCommande(Request $request ,$id): Response
    {

        $commande=$this->entityManager->getRepository(Commande::class)->findOneById($id);


        $form=$this->createForm(RdvCommandeModifType::class, $commande);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid())
        {

            $this->entityManager->flush();

            return $this->redirectToRoute("message_rdv");
        }



        return $this->render('compte_client/updateRdvCommande.html.twig', [
            'commande'=>$commande,
            'formModifRdvCommande'=>$form->createView()
        ]);
    }

}




