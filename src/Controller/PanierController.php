<?php

namespace App\Controller;

use App\Classe\Panier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }


    /**
     * @Route("/mon-panier", name="panier")
     */
    public function index(Panier $panier): Response
    {

        //dd($panier->get());


        return $this->render('panier/index.html.twig', [
            'panier' =>$panier->getAll() ,
        ]);
    }


    /**
     * @Route("/panier/add/{id}", name="add_panier")
     */
    public function add(Panier $panier,$id): Response
    {
        $panier->add($id);

        return $this->redirectToRoute('panier');
    }


    /**
     * @Route("/panier/remove", name="remove_panier")
     */
    public function remove(Panier $panier): Response
    {
        $panier->panierRemove();

        return $this->redirectToRoute('account', array(
            'id' => $this->getUser()->getUserIdentifier(),
        ));
    }


    /**
     * @Route("/panier/delete/{id}", name="delete_panier")
     */
    public function delete(Panier $panier,$id): Response
    {
        $panier->delete($id);

        //dd($id);
        return $this->redirectToRoute('panier');
    }



    /**
     * @Route("/panier/decrease/{id}", name="decrease_panier")
     */
    public function decrease(Panier $panier,$id): Response
    {
        $panier->decrease($id);

        return $this->redirectToRoute('panier');
    }






}
