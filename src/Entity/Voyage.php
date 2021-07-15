<?php

namespace App\Entity;

use App\Repository\VoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoyageRepository::class)
 */
class Voyage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRetour;

    /**
     * @ORM\Column(type="float")
     */
    private $tarif;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlace;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponibilite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $assurance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statutVoyage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity=Participants::class, inversedBy="listeVoyages")
     */
    private $listeClients;

    /**
     * @ORM\OneToOne(targetEntity=Hebergement::class, mappedBy="voyage", cascade={"persist", "remove"})
     */
    private $hebergement;

    /**
     * @ORM\OneToOne(targetEntity=Formule::class, mappedBy="voyage", cascade={"persist", "remove"})
     */
    private $formule;

    /**
     * @ORM\OneToOne(targetEntity=Destination::class, mappedBy="voyage", cascade={"persist", "remove"})
     */
    private $destination;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reduction;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $aimeParCons;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $servicesPropose;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tarifMoins12;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="voyage")
     */
    private $listeCommandes;

 /*   /**
     * @ORM\Column(type="integer")
     */
   // private $duree;

    public function __construct()
    {
        $this->listeClients = new ArrayCollection();
        $this->listeCommandes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getId().$this->getTarif()
            .' [br] '.$this->getNbPlace().' [br] '.$this->getDisponibilite().' [br] '.$this->getAssurance()
            .' [br] '.$this->getStatutVoyage().$this->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nbPlace;
    }

    public function setNbPlace(int $nbPlace): self
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    public function getDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getAssurance(): ?bool
    {
        return $this->assurance;
    }

    public function setAssurance(bool $assurance): self
    {
        $this->assurance = $assurance;

        return $this;
    }

    public function getStatutVoyage(): ?string
    {
        return $this->statutVoyage;
    }

    public function setStatutVoyage(string $statutVoyage): self
    {
        $this->statutVoyage = $statutVoyage;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getListeClients(): Collection
    {
        return $this->listeClients;
    }

    public function addListeClient(Client $listeClient): self
    {
        if (!$this->listeClients->contains($listeClient)) {
            $this->listeClients[] = $listeClient;
        }

        return $this;
    }

    public function removeListeClient(Client $listeClient): self
    {
        $this->listeClients->removeElement($listeClient);

        return $this;
    }

    public function getHebergement(): ?Hebergement
    {
        return $this->hebergement;
    }

    public function setHebergement(?Hebergement $hebergement): self
    {
        // unset the owning side of the relation if necessary
        if ($hebergement === null && $this->hebergement !== null) {
            $this->hebergement->setVoyage(null);
        }

        // set the owning side of the relation if necessary
        if ($hebergement !== null && $hebergement->getVoyage() !== $this) {
            $hebergement->setVoyage($this);
        }

        $this->hebergement = $hebergement;

        return $this;
    }

    public function getFormule(): ?Formule
    {
        return $this->formule;
    }

    public function setFormule(?Formule $formule): self
    {
        // unset the owning side of the relation if necessary
        if ($formule === null && $this->formule !== null) {
            $this->formule->setVoyage(null);
        }

        // set the owning side of the relation if necessary
        if ($formule !== null && $formule->getVoyage() !== $this) {
            $formule->setVoyage($this);
        }

        $this->formule = $formule;

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): self
    {
        // unset the owning side of the relation if necessary
        if ($destination === null && $this->destination !== null) {
            $this->destination->setVoyage(null);
        }

        // set the owning side of the relation if necessary
        if ($destination !== null && $destination->getVoyage() !== $this) {
            $destination->setVoyage($this);
        }

        $this->destination = $destination;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

   /* public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }  */

   public function getDuree(): ?int
   {
       return $this->duree;
   }

   public function setDuree(int $duree): self
   {
       $this->duree = $duree;

       return $this;
   }

   public function getDescription(): ?string
   {
       return $this->description;
   }

   public function setDescription(string $description): self
   {
       $this->description = $description;

       return $this;
   }

   public function getReduction(): ?string
   {
       return $this->reduction;
   }

   public function setReduction(?string $reduction): self
   {
       $this->reduction = $reduction;

       return $this;
   }

   public function getAimeParCons(): ?string
   {
       return $this->aimeParCons;
   }

   public function setAimeParCons(?string $aimeParCons): self
   {
       $this->aimeParCons = $aimeParCons;

       return $this;
   }

   public function getServicesPropose(): ?string
   {
       return $this->servicesPropose;
   }

   public function setServicesPropose(?string $servicesPropose): self
   {
       $this->servicesPropose = $servicesPropose;

       return $this;
   }

   public function getTarifMoins12(): ?float
   {
       return $this->tarifMoins12;
   }

   public function setTarifMoins12(?float $tarifMoins12): self
   {
       $this->tarifMoins12 = $tarifMoins12;

       return $this;
   }

   /**
    * @return Collection|Commande[]
    */
   public function getListeCommandes(): Collection
   {
       return $this->listeCommandes;
   }

   public function addListeCommande(Commande $listeCommande): self
   {
       if (!$this->listeCommandes->contains($listeCommande)) {
           $this->listeCommandes[] = $listeCommande;
           $listeCommande->setVoyage($this);
       }

       return $this;
   }

   public function removeListeCommande(Commande $listeCommande): self
   {
       if ($this->listeCommandes->removeElement($listeCommande)) {
           // set the owning side to null (unless already changed)
           if ($listeCommande->getVoyage() === $this) {
               $listeCommande->setVoyage(null);
           }
       }

       return $this;
   }
}
