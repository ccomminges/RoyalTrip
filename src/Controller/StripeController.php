<?php

namespace App\Controller;

use App\Classe\Panier;
use App\Entity\Commande;
use App\Entity\Voyage;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    /**
     * @Route("/stripe/creer-session/{reference}", name="stripe_creer_session")
     */
    public function index(EntityManagerInterface $entityManager, Panier $panier, $reference): Response
    {

        $voyagePourStripe=[];

        $YOUR_DOMAIN = 'http://127.0.0.1:8000';

        $commande=$entityManager->getRepository(Commande::class)->findOneByReference($reference);



        if(!$commande)
        {
            new JsonResponse(["erreur"=>"commande"]);
        }

        foreach ($commande->getListeDetailCommandes()->getValues() as $voy)
        {
            $voy_object=$entityManager->getRepository(Voyage::class)->findOneByNom($voy->getVoyageNom());

            $voyagePourStripe[]=[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $voy->getTotal()*100,
                    'product_data' => [
                        'name' => $voy->getVoyageNom(),
                        'images' => [$YOUR_DOMAIN."/uploads/voyage/".$voy_object->getPhoto()]
                    ],
                ],
                'quantity' => $voy->getQuantite(),
            ];
        }

        Stripe::setApiKey('sk_test_51J5BUNLFINe82BV88eJ1avhSR577twyEw9PFDPpxi1f8seTEYVTRg0016kyA7Q4Qt4F94arbsdW8tgEgd34xl6zN00wIZ1uISz');

        $checkout_session = Session::create([
            'customer_email'=> $this->getUser()->getEmail(),
            'payment_method_types' => ['card'],
            'line_items' => [
                $voyagePourStripe
            ],
            'mode' => 'payment',
            // CHECKOUT_SESSION_ID GENERE UN ID DE SESSION POUR STRIPE : ce param est automatiquement remplacé par Stripe
            'success_url' => $YOUR_DOMAIN.'/stripe/merci/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN.'/stripe/erreur/{CHECKOUT_SESSION_ID}'
        ]);

        $commande->setStripeSessionId($checkout_session->id);

        $entityManager->flush();

        $response=new JsonResponse(["id"=>$checkout_session->id]);


        return $response;

    }
}
