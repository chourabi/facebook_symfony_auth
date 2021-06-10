<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
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
    private $username;

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
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $facebookAccessToken;

    /**
     * @ORM\OneToMany(targetEntity=LinkedFacebookPage::class, mappedBy="user")
     */
    private $linkedFacebookPages;

    public function __construct()
    {
        $this->linkedFacebookPages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

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

    public function getFacebookAccessToken(): ?string
    {
        return $this->facebookAccessToken;
    }

    public function setFacebookAccessToken(?string $facebookAccessToken): self
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    /**
     * @return Collection|LinkedFacebookPage[]
     */
    public function getLinkedFacebookPages(): Collection
    {
        return $this->linkedFacebookPages;
    }

    public function addLinkedFacebookPage(LinkedFacebookPage $linkedFacebookPage): self
    {
        if (!$this->linkedFacebookPages->contains($linkedFacebookPage)) {
            $this->linkedFacebookPages[] = $linkedFacebookPage;
            $linkedFacebookPage->setUser($this);
        }

        return $this;
    }

    public function removeLinkedFacebookPage(LinkedFacebookPage $linkedFacebookPage): self
    {
        if ($this->linkedFacebookPages->removeElement($linkedFacebookPage)) {
            // set the owning side to null (unless already changed)
            if ($linkedFacebookPage->getUser() === $this) {
                $linkedFacebookPage->setUser(null);
            }
        }

        return $this;
    }
}
