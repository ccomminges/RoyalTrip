<?php

namespace App\Controller;

use App\Classe\Panier;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeSuccesController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }


    /**
     * @Route("/stripe/merci/{stripeSessionId}", name="commande_succes")
     */
    public function index($stripeSessionId, Panier $panier): Response
    {

        $commande=$this->entityManager->getRepository(Commande::class)->findOneByStripeSessionId($stripeSessionId);

        if(!$commande || $commande->getClient() != $this->getUser())
        {
            return $this->redirectToRoute('home');
        }


        //Vider la session cart
        $panier->panierRemove();


        //Modifier le statut  de la commande en le passant à 2
        $commande->setEtat(2);
        $this->entityManager->flush();

        //Envoie email




        return $this->render('commande_succes/index.html.twig', [
            'commande' => $commande,
        ]);
    }
}
