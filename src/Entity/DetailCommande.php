<?php

namespace App\Entity;

use App\Repository\DetailCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailCommandeRepository::class)
 */
class DetailCommande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voyageNom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="listeDetailCommandes", cascade={"persist"})
     */
    private $commande;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbPersPlus12;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbPersMoins12;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $ReductionMoins12;


    public function __toString()
    {
        return $this->getId().'[br]'.$this->getVoyageNom().'[br]'.$this->getQuantite().' [br] '.$this->getPrix()
            .' [br] '.$this->getTotal();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoyageNom(): ?string
    {
        return $this->voyageNom;
    }

    public function setVoyageNom(string $voyageNom): self
    {
        $this->voyageNom = $voyageNom;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getNbPersPlus12(): ?int
    {
        return $this->NbPersPlus12;
    }

    public function setNbPersPlus12(int $NbPersPlus12): self
    {
        $this->NbPersPlus12 = $NbPersPlus12;

        return $this;
    }

    public function getNbPersMoins12(): ?int
    {
        return $this->NbPersMoins12;
    }

    public function setNbPersMoins12(int $NbPersMoins12): self
    {
        $this->NbPersMoins12 = $NbPersMoins12;

        return $this;
    }

    public function getReductionMoins12(): ?float
    {
        return $this->ReductionMoins12;
    }

    public function setReductionMoins12(?float $ReductionMoins12): self
    {
        $this->ReductionMoins12 = $ReductionMoins12;

        return $this;
    }
}
