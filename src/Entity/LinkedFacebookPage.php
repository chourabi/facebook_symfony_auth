<?php

namespace App\Entity;

use App\Repository\LinkedFacebookPageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LinkedFacebookPageRepository::class)
 */
class LinkedFacebookPage
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
    private $pageID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pageAccessToken;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pageName;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="linkedFacebookPages")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPageID(): ?string
    {
        return $this->pageID;
    }

    public function setPageID(string $pageID): self
    {
        $this->pageID = $pageID;

        return $this;
    }

    public function getPageAccessToken(): ?string
    {
        return $this->pageAccessToken;
    }

    public function setPageAccessToken(string $pageAccessToken): self
    {
        $this->pageAccessToken = $pageAccessToken;

        return $this;
    }

    public function getPageName(): ?string
    {
        return $this->pageName;
    }

    public function setPageName(string $pageName): self
    {
        $this->pageName = $pageName;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
