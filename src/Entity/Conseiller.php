<?php

namespace App\Entity;

use App\Repository\ConseillerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=ConseillerRepository::class)
 */
class Conseiller implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $questionnaire;

    /**
     * @ORM\OneToMany(targetEntity=Participants::class, mappedBy="conseiller")
     */
    private $listeClients;

    public function __construct()
    {
        $this->listeClients = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getId().'[br]'.$this->getLogin().' [br] '.$this->getPassword()
            .' [br] '.$this->getNom().' [br] '.$this->getPrenom().' [br] '.$this->getTelephone()
            .' [br] '.$this->getQuestionnaire();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_ADMIN';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getQuestionnaire(): ?string
    {
        return $this->questionnaire;
    }

    public function setQuestionnaire(?string $questionnaire): self
    {
        $this->questionnaire = $questionnaire;

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
            $listeClient->setConseiller($this);
        }

        return $this;
    }

    public function removeListeClient(Client $listeClient): self
    {
        if ($this->listeClients->removeElement($listeClient)) {
            // set the owning side to null (unless already changed)
            if ($listeClient->getConseiller() === $this) {
                $listeClient->setConseiller(null);
            }
        }

        return $this;
    }
}
