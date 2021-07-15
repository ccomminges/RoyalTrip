<?php


namespace App\Classe;


use App\Entity\Voyage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Panier
{

    private $session;
    private $entityManager;


    public function __construct(SessionInterface $session, EntityManagerInterface $entityManager)
    {
        $this->session=$session;
        $this->entityManager=$entityManager;
    }



    public function get()
    {
        return $this->session->get('panier');
    }


    public function getAll()
    {
        $panierComplet=[];

        if($this->get())
        {

            foreach ($this->get() as $id => $quantite)
            {

                //foreach ($this->get() as $id => $quantityMoins12) {

                    $voyage_object=$this->entityManager->getRepository(Voyage::class)->findOneById($id);

                   /* if($voyage_object)
                    {
                        $this->delete($id);
                        continue;
                    } */

                    $panierComplet[] = [
                        'voyageNom' => $voyage_object,
                        'quantite' => $quantite,
                       // 'quantityMoins12' => $quantityMoins12
                    ];

                }
            }

       // }
        return $panierComplet;
    }

    //pour fonction add controller
    public function panierRemove()
    {
        $this->session->remove('panier');
    }



    public function delete($id)
    {
        $panier=$this->session->get('panier');

        unset($panier[$id]);

        return $this->session->set('panier',$panier);
    }



    public function decrease($id)
    {
        $panier= $this->session->get('panier',[]);

        //Vérifier si la quantité n'est pas égale à 1
        if($panier[$id]>1)
        {
            $panier[$id] --;

        }
        else{
            unset($panier[$id]);
        }

        return $this->session->set('panier',$panier);
    }




    public function add($id)
    {
        $panier= $this->session->get('panier',[]);

        if(!empty($panier[$id]))
        {
            $panier[$id] ++;
        }
        else{
            $panier[$id]=1;
        }

        $this->session->set('panier',$panier);
    }


}