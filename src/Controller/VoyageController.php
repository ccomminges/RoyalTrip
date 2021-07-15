<?php

namespace App\Controller;

use App\Classe\CritereRecherche;
use App\Entity\Voyage;
use App\Form\CritereRechercheType;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoyageController extends AbstractController
{
    //Déclaration de l'attribut de type EntityManager :
    private $entityManager;

    //constructeur :

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }


    /**
     * @Route("/voyages", name="voyages")
     */
    public function index(Request $request): Response
    {

       /* $search=new CritereRecherche();
        $form=$this->createForm(CritereRechercheType::class);

        //Regarder si le formulaire a été soumis :
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $listeVoyages=$this->entityManager->getRepository(Voyage::class)->findWithSearch($search);
        }
        else
        {
            $listeVoyages=$this->entityManager->getRepository(Voyage::class)->findAll();
        }


        return $this->render('voyage/index.html.twig', [

            'voyages'=>$listeVoyages,
            'formVoyage'=>$form->createView()
        ]);   */
    }


    /**
     * @Route("/voyage/{id}", name="voyage")
     */
    public function afficheVoyageParId($id): Response
    {

        //Récupérer le résultat de la méthode findOneById :
        $voyage = $this->entityManager->getRepository(Voyage::class)->findOneById($id);

        if(!$voyage)
        {
            return $this->redirectToRoute('home');
        }



         return $this->render('home/showDetail.html.twig', [
             "voyage"=>$voyage
         ]);
    }

}
