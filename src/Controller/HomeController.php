<?php

namespace App\Controller;

use App\Classe\CritereRecherche;
use App\Entity\Voyage;
use App\Form\CritereRechercheType;
use App\Form\NousContacterType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        //Partie du formulaire de contact de la page d'accueil
        $formNousContact=$this->createForm(NousContacterType::class);

        $formNousContact->handleRequest($request);

        if( $formNousContact->isSubmitted() && $formNousContact->isValid() )
        {
            $this->addFlash('notice',"Votre requête a bien été soumise. Nous vous répondrons dans les plus bref délais.");

            /// ENVOIE EMAIL APRES SOUMISSION
        }



        //Partie de l'affichage des voyages proposés :
        $search=new CritereRecherche();
        $formVoyage=$this->createForm(CritereRechercheType::class, $search);

        //Regarder si le formulaire a été soumis :
        $formVoyage->handleRequest($request);

        if($formVoyage->isSubmitted() && $formVoyage->isValid())
        {
            //dd($search);

           $listeVoyages=$this->entityManager->getRepository(Voyage::class)->findWithSearch($search);

            $voyPagine=$paginator->paginate(
                $listeVoyages,  //données
                $request->query->getInt('page',1),  //numéro de la page en cours
                9
            );
        }
        else
        {
            $listeVoyages=$this->entityManager->getRepository(Voyage::class)->findAll();
            $voyPagine=$paginator->paginate(
                $listeVoyages,  //données
                $request->query->getInt('page',1),  //numéro de la page en cours
                9
            );
        }




        return $this->render('home/index.html.twig',
        [
            'formNousContact'=>$formNousContact->createView(),
            'voyages'=>$listeVoyages,
            'formVoyage'=>$formVoyage->createView(),
            'voyPagine'=>$voyPagine
        ]);
    }
}
