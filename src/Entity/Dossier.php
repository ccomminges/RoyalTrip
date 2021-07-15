<?php

namespace App\Entity;

use App\Repository\DossierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DossierRepository::class)
 */
class Dossier
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
    private $dateCreation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateLimite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statutDossier;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlaceReserve;

    /**
     * @ORM\Column(type="boolean")
     */
    private $annulation;

    /**
     * @ORM\OneToOne(targetEntity=Participants::class, inversedBy="dossier", cascade={"persist", "remove"})
     */
    private $client;

    public function __toString()
    {
        return $this->getId().'[br]'.$this->getDateCreation().'[br]'.$this->getDateLimite().' [br] '.$this->getStatutDossier()
            .' [br] '.$this->getNbPlaceReserve().' [br] '.$this->getAnnulation();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateLimite(): ?\DateTimeInterface
    {
        return $this->dateLimite;
    }

    public function setDateLimite(\DateTimeInterface $dateLimite): self
    {
        $this->dateLimite = $dateLimite;

        return $this;
    }

    public function getStatutDossier(): ?string
    {
        return $this->statutDossier;
    }

    public function setStatutDossier(string $statutDossier): self
    {
        $this->statutDossier = $statutDossier;

        return $this;
    }

    public function getNbPlaceReserve(): ?int
    {
        return $this->nbPlaceReserve;
    }

    public function setNbPlaceReserve(int $nbPlaceReserve): self
    {
        $this->nbPlaceReserve = $nbPlaceReserve;

        return $this;
    }

    public function getAnnulation(): ?bool
    {
        return $this->annulation;
    }

    public function setAnnulation(bool $annulation): self
    {
        $this->annulation = $annulation;

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
}
