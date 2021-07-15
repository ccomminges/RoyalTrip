<?php

namespace App\Entity;

use App\Repository\FormuleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormuleRepository::class)
 */
class Formule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $avion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hotel;

    /**
     * @ORM\Column(type="boolean")
     */
    private $voiture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $guide;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\OneToOne(targetEntity=Voyage::class, inversedBy="formule", cascade={"persist", "remove"})
     */
    private $voyage;

    /**
     * @ORM\OneToOne(targetEntity=Voiture::class, mappedBy="formule", cascade={"persist", "remove"})
     */
    private $voitType;

    public function __toString()
    {
        return $this->getId().'[br]'.$this->getAvion().'[br]'.$this->getHotel().' [br] '.$this->getVoiture()
            .' [br] '.$this->getGuide();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvion(): ?bool
    {
        return $this->avion;
    }

    public function setAvion(bool $avion): self
    {
        $this->avion = $avion;

        return $this;
    }

    public function getHotel(): ?bool
    {
        return $this->hotel;
    }

    public function setHotel(bool $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getVoiture(): ?bool
    {
        return $this->voiture;
    }

    public function setVoiture(bool $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getGuide(): ?bool
    {
        return $this->guide;
    }

    public function setGuide(bool $guide): self
    {
        $this->guide = $guide;

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

    public function getVoyage(): ?Voyage
    {
        return $this->voyage;
    }

    public function setVoyage(?Voyage $voyage): self
    {
        $this->voyage = $voyage;

        return $this;
    }

    public function getVoitType(): ?Voiture
    {
        return $this->voitType;
    }

    public function setVoitType(?Voiture $voitType): self
    {
        // unset the owning side of the relation if necessary
        if ($voitType === null && $this->voitType !== null) {
            $this->voitType->setFormule(null);
        }

        // set the owning side of the relation if necessary
        if ($voitType !== null && $voitType->getFormule() !== $this) {
            $voitType->setFormule($this);
        }

        $this->voitType = $voitType;

        return $this;
    }
}
