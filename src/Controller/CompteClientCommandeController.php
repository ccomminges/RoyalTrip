<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commande;
use App\Form\ClientProfilModifType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CompteClientCommandeController extends AbstractController
{
    private $entityManager;
    private $session;



    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager=$entityManager;
        $this->session=$session;
    }


    /**
     * @Route("/compte/mes-commandes", name="compte_client_commande")
     */
    public function index(): Response
    {

        $listesCommandes=$this->entityManager->getRepository(Commande::class)->findCommandesByClient($this->getUser());



        return $this->render('compte_client/listeCommandes.html.twig', [
            'listeCommandes'=>$listesCommandes
        ]);
    }



/**
 * @Route("/compte/mes-commandes/{reference}", name="compte_commande_show")
 */
public function show($reference): Response
{

    $commande=$this->entityManager->getRepository(Commande::class)->findOneByReference($reference);


    if(!$commande || $commande->getClient() != $this->getUser())
    {
        return $this->redirectToRoute('compte_client_commande');
    }

    return $this->render('compte_client/showCommande.html.twig', [
        'commande'=>$commande
    ]);
}



    /**
     * @Route("/compte/supprimer-commande/{id}", name="delete_commande")
     */
    public function deleteCommande(Request $request ,$id): Response
    {

        $commande=$this->entityManager->getRepository(Commande::class)->findOneById($id);


        $this->entityManager->remove($commande);

        $commandes=$this->entityManager->getRepository(Commande::class)->findAll();


        return $this->render('compte_client/listeCommandes.html.twig', [
            'listeCommandes'=>$commandes
        ]);
    }



    /**
     * @Route("/compte/message-rdv", name="message_rdv")
     */
    public function messageRdv(): Response
    {

        $client=$this->getUser();

        $commande=$this->entityManager->getRepository(Commande::class)->findOneByClient($this->getUser());






        return $this->render('compte_client/messageRdv.html.twig', [
            'client'=>$client,
            'commande'=>$commande
        ]);
    }


}
