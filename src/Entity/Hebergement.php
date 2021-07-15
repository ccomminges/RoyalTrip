<?php

namespace App\Entity;

use App\Repository\HebergementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HebergementRepository::class)
 */
class Hebergement
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
    private $hebSeul;

    /**
     * @ORM\Column(type="boolean")
     */
    private $petitDej;

    /**
     * @ORM\Column(type="boolean")
     */
    private $demiPension;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pensionComplete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\OneToOne(targetEntity=Voyage::class, inversedBy="hebergement", cascade={"persist", "remove"})
     */
    private $voyage;

    public function __toString()
    {
        return $this->getId().'[br]'.$this->getHebSeul().'[br]'.$this->getPetitDej().' [br] '.$this->getDemiPension()
            .' [br] '.$this->getPensionComplete();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHebSeul(): ?bool
    {
        return $this->hebSeul;
    }

    public function setHebSeul(bool $hebSeul): self
    {
        $this->hebSeul = $hebSeul;

        return $this;
    }

    public function getPetitDej(): ?bool
    {
        return $this->petitDej;
    }

    public function setPetitDej(bool $petitDej): self
    {
        $this->petitDej = $petitDej;

        return $this;
    }

    public function getDemiPension(): ?bool
    {
        return $this->demiPension;
    }

    public function setDemiPension(bool $demiPension): self
    {
        $this->demiPension = $demiPension;

        return $this;
    }

    public function getPensionComplete(): ?bool
    {
        return $this->pensionComplete;
    }

    public function setPensionComplete(bool $pensionComplete): self
    {
        $this->pensionComplete = $pensionComplete;

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
}
