<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $heureRDV;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateRDV;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rdvPresentiel;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stripeSessionId;

    /**
     * @ORM\OneToMany(targetEntity=DetailCommande::class, mappedBy="commande")
     */
    private $listeDetailCommandes;

    /**
     * @ORM\ManyToOne(targetEntity=Participants::class, inversedBy="listeCommandes")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Voyage::class, inversedBy="listeCommandes")
     */
    private $voyage;

    public function __construct()
    {
        $this->listeDetailCommandes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getId().' [br] ';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureRDV(): ?\DateTimeInterface
    {
        return $this->heureRDV;
    }

    public function setHeureRDV(\DateTimeInterface $heureRDV): self
    {
        $this->heureRDV = $heureRDV;

        return $this;
    }

    public function getDateRDV(): ?\DateTimeInterface
    {
        return $this->dateRDV;
    }

    public function setDateRDV(\DateTimeInterface $dateRDV): self
    {
        $this->dateRDV = $dateRDV;

        return $this;
    }

    public function getRdvPresentiel(): ?bool
    {
        return $this->rdvPresentiel;
    }

    public function setRdvPresentiel(bool $rdvPresentiel): self
    {
        $this->rdvPresentiel = $rdvPresentiel;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getStripeSessionId(): ?string
    {
        return $this->stripeSessionId;
    }

    public function setStripeSessionId(?string $stripeSessionId): self
    {
        $this->stripeSessionId = $stripeSessionId;

        return $this;
    }

    /**
     * @return Collection|DetailCommande[]
     */
    public function getListeDetailCommandes(): Collection
    {
        return $this->listeDetailCommandes;
    }

    public function addListeDetailCommande(DetailCommande $listeDetailCommande): self
    {
        if (!$this->listeDetailCommandes->contains($listeDetailCommande)) {
            $this->listeDetailCommandes[] = $listeDetailCommande;
            $listeDetailCommande->setCommande($this);
        }

        return $this;
    }

    public function removeListeDetailCommande(DetailCommande $listeDetailCommande): self
    {
        if ($this->listeDetailCommandes->removeElement($listeDetailCommande)) {
            // set the owning side to null (unless already changed)
            if ($listeDetailCommande->getCommande() === $this) {
                $listeDetailCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getVoyage(): ?Voyage
    {
        return $this->voyage;
    }

    public function setVoyage(?Voyage $voyage): self
    {
        $this->voyage = $voyage;

        return $this;
    }
}
