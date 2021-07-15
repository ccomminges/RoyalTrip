<?php

namespace App\Controller;

use App\Classe\Mails;
use App\Entity\Client;
use App\Entity\ResetMdp;
use App\Form\ResetMdpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MDPOublieController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }


    /**
     * @Route("/mdpOublie", name="mdp_oublie")
     */
    public function index(Request $request): Response
    {

        //Si l'utilisateur est connecté :
        if($this->getUser())
        {
            return $this->redirectToRoute('home');
        }

        //Chercher le parametre email : si il a été envoyé
        if($request->get('email'))
        {
            $user=$this->entityManager->getRepository(Client::class)->findOneByEmail($request->get('email'));


            //Si l'utilisateur existe
            if($user)
            {
                $newMdp=new ResetMdp();
                $newMdp->setClient($user);
                $newMdp->setToken(uniqid());
                $newMdp->setDateCreation(new \DateTime());
                $this->entityManager->persist($newMdp);
                $this->entityManager->flush();


                //génére l'url dans le $content
                $url=$this->generateUrl("modifier_mdp", [
                    'token'=>$newMdp->getToken()
                ]);


                $content="Bonjour, ".$user->getPrenom()." ".$user->getNom()."<br>. Vous avez demandé à réinitialiser votre mot de passe<br>
                Merci de bien cliquer sur le lien suivant pour <a href='".$url."'>mettre à jour votre mot de passe</a>";

                //envoyer email à l'utilisateur avec un lien pour mettre à jour mdp
                $mail=new Mails();
                $mail->sendMail($user->getEmail(), $user->getPrenom().' '.$user->getNom(),
                    'Réinitialisation votre mot de passe : agence ROYALTRIP',$content);

                $this->addFlash('notice','Vous allez recevoir un email avec la procédure
                pour réinitialiser votre mot de passe');


            }
            else{
                $this->addFlash('notice',"L'adresse email saisie est inconnue");
            }

        }


        return $this->render('mdp_oublie/index.html.twig', [

        ]);
    }



    /**
     * @Route("/modifierMdp/{token}", name="modifier_mdp")
     */
    public function modifier(Request $request, $token, UserPasswordEncoderInterface  $encoder): Response
    {

        //dans le but de récupérer le user et le createdAt à partir du token
        $newMdp=$this->entityManager->getRepository(ResetMdp::class)->findOneByToken($token);


        //Redirection si n'existe pas
        if(!$newMdp)
        {
            return $this->redirectToRoute('mdp_oublie');
        }

        $dateActuelle=new \DateTime();


        //Verif si createdAt=maintenant-7h
        if($dateActuelle < $newMdp->getDateCreation()->modify('+ 7 hour'))
        {
            $this->addFlash('notice','Votre demande de réanitialisation de mot de passe a expiré, merci de la renouvellé');
            return $this->redirectToRoute('mdp_oublie');
        }

        //dd : debug
        //die : écrit

        $form=$this->createForm(ResetMdpType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $newPwd=$form->get('nouveauMdp')->getData();

            //Encodage des mots de passes
            $mdp=  $encoder->encodePassword($newMdp->getClient(), $newPwd);

            $newMdp->getClient()->setPassword($mdp);

            //Flush en base de donnée
            $this->entityManager->flush();

            //Redirection de l'utilisateur vers la page de connexion
            $this->addFlash('notice','Votre mot de passe a bien été mise à jour');
            return $this->redirectToRoute('app_login');

        }


        return $this->render('mdp_oublie/update.html.twig', [
                'formMdpOublie'=>$form->createView()
        ]);
    }



}
