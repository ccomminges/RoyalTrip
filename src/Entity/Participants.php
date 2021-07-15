<?php

namespace App\Entity;

use App\Repository\ParticipantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipantsRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "client" = "Client",
 *     "participant" = "Participants"
 * })
 */
class Participants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $prenom;

    /**
     * @ORM\Column(type="integer")
     */
    protected $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $civilite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $telephone;

    /**
     * @ORM\Column(type="date")
     */
    protected $dateNaissance;



    //Associations :
    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="client")
     */
    private $listeCommandes;

    /**
     * @ORM\ManyToOne(targetEntity=Conseiller::class, inversedBy="listeClients")
     */
    private $conseiller;

    /**
     * @ORM\OneToOne(targetEntity=Dossier::class, mappedBy="client", cascade={"persist", "remove"})
     */
    private $dossier;

    /**
     * @ORM\ManyToMany(targetEntity=Voyage::class, mappedBy="listeClients")
     */
    private $listeVoyages;

    /**
     * @ORM\OneToMany(targetEntity=ResetMdp::class, mappedBy="client")
     */
    private $resetMdps;


    public function __construct()
    {
        $this->listeCommandes = new ArrayCollection();
        $this->listeVoyages = new ArrayCollection();
        $this->resetMdps = new ArrayCollection();
    }



    public function __toString()
    {
        return $this->getId().'[br]'.$this->getNom().'[br]'.$this->getPrenom().' [br] '.$this->getAge()
            .' [br] '.$this->getCivilite().' [br] '.$this->getAdresse().' [br] '.$this->getTelephone()
            .' [br] '.$this->getDateNaissance();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

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
            $listeCommande->setClient($this);
        }

        return $this;
    }

    public function removeListeCommande(Commande $listeCommande): self
    {
        if ($this->listeCommandes->removeElement($listeCommande)) {
            // set the owning side to null (unless already changed)
            if ($listeCommande->getClient() === $this) {
                $listeCommande->setClient(null);
            }
        }

        return $this;
    }

    public function getConseiller(): ?Conseiller
    {
        return $this->conseiller;
    }

    public function setConseiller(?Conseiller $conseiller): self
    {
        $this->conseiller = $conseiller;

        return $this;
    }

    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(?Dossier $dossier): self
    {
        // unset the owning side of the relation if necessary
        if ($dossier === null && $this->dossier !== null) {
            $this->dossier->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($dossier !== null && $dossier->getClient() !== $this) {
            $dossier->setClient($this);
        }

        $this->dossier = $dossier;

        return $this;
    }

    /**
     * @return Collection|Voyage[]
     */
    public function getListeVoyages(): Collection
    {
        return $this->listeVoyages;
    }

    public function addListeVoyage(Voyage $listeVoyage): self
    {
        if (!$this->listeVoyages->contains($listeVoyage)) {
            $this->listeVoyages[] = $listeVoyage;
            $listeVoyage->addListeClient($this);
        }

        return $this;
    }

    public function removeListeVoyage(Voyage $listeVoyage): self
    {
        if ($this->listeVoyages->removeElement($listeVoyage)) {
            $listeVoyage->removeListeClient($this);
        }

        return $this;
    }

    /**
     * @return Collection|ResetMdp[]
     */
    public function getResetMdps(): Collection
    {
        return $this->resetMdps;
    }

    public function addResetMdp(ResetMdp $resetMdp): self
    {
        if (!$this->resetMdps->contains($resetMdp)) {
            $this->resetMdps[] = $resetMdp;
            $resetMdp->setClient($this);
        }

        return $this;
    }

    public function removeResetMdp(ResetMdp $resetMdp): self
    {
        if ($this->resetMdps->removeElement($resetMdp)) {
            // set the owning side to null (unless already changed)
            if ($resetMdp->getClient() === $this) {
                $resetMdp->setClient(null);
            }
        }

        return $this;
    }

}
