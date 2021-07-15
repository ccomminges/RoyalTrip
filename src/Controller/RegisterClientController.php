<?php

namespace App\Controller;

use App\Classe\Mails;
use App\Entity\Client;
use App\Form\RegisterClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterClientController extends AbstractController
{

    /*injection de dépendance */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }


    /**
     * @Route("/inscriptionClient", name="register_client")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $notification=null;

        $client=new Client();

        $form=$this->createForm(RegisterClientType::class, $client);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $client=$form->getData();

            $searchEmail=$this->entityManager->getRepository(Client::class)->findOneByEmail($client->getEmail());

            if(!$searchEmail) {
                $pwd=$encoder->encodePassword($client, $client->getPassword());
                $client->setPassword($pwd);


                $this->entityManager->persist($client);
                $this->entityManager->flush();


                /// FAIRE LA PARTIE ENVOIE DE MAIL AU CLIENT

                /* $mail=new Mails();
                $content="Bonjour ".$client->getPrenom()."vous êtes bien inscrit sur la boutique française";
                $mail->sendMail($client->getEmail(), $client->getPrenom(),'Bienvenue dans la Boutique française', $content);
*/

               // dd($mail);

                $notification=" Vous possedez désormais un compte client ";
            }
            else
            {
                $notification=" Un problème est survenue lors de la procédure";
            }
        }

        return $this->render('register_client/index.html.twig', [
            'formRegister' => $form->createView(),
            'notification'=>$notification
        ]);
    }
}
