<?php

namespace App\Controller;

use App\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeErreurController extends AbstractController
{
    /**
     * @Route("/stripe/erreur/{stripeSessionId}", name="commande_erreur")
     */
    public function index($stripeSessionId): Response
    {

        $commande=$this->entityManager->getRepository(Commande::class)->findOneByStripeSessionId($stripeSessionId);

        if(!$commande || $commande->getClient() != $this->getUser())
        {
            return $this->redirectToRoute('home');
        }


        return $this->render('commande_erreur/index.html.twig', [
            'commande' => $commande,
        ]);
    }
}
