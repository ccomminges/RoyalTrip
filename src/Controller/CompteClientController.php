<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientProfilModifType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteClientController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }


    /**
     * @Route("/compte/{email}", name="account")
     */
    public function index($email): Response
    {

        $client=$this->entityManager->getRepository(Client::class)->findOneByEmail($email);


        return $this->render('compte_client/index.html.twig', [
            'client'=>$client
        ]);
    }


    /**
     * @Route("/compte/mon-profil/{id}", name="show_profil")
     */
    public function showProfil($id): Response
    {

        $client=$this->entityManager->getRepository(Client::class)->findOneById($id);

        return $this->render('compte_client/showProfil.html.twig', [
            'client'=>$client
        ]);
    }



    /**
     * @Route("/compte/modifier-profil/{id}", name="update_profil")
     */
    public function updateProfil(Request $request ,$id): Response
    {

        $client=$this->entityManager->getRepository(Client::class)->findOneById($id);


        $form=$this->createForm(ClientProfilModifType::class, $client);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid())
        {

            $this->entityManager->flush();

            return $this->redirectToRoute("show_profil", array(
                'id' => $id,
            ));
        }



        return $this->render('compte_client/updateProfil.html.twig', [
            'client'=>$client,
            'formModifProfil'=>$form->createView()
        ]);
    }



    /**
     * @Route("/compte/afficher-conseiller/{id}", name="show_conseiller")
     */
    public function showConseiller($id): Response
    {

        $notification = null;

        $client=$this->entityManager->getRepository(Client::class)->afficheConseillerDuClient($id);

        //dd($client);


       if(!$client)
        {
            $notification = " Vous n'avez pas de conseillers attribué. Veuillez valider la réservation
             d'un voyage pour vous voir attribuer un conseiller qui traitera votre demande
             de séjour";

       }



        return $this->render('compte_client/showConseiller.html.twig', [
            'client'=>$client,
            'notification'=>$notification
        ]);
    }

}
