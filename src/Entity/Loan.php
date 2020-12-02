<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LoanRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @ORM\Entity(repositoryClass=LoanRepository::class)
 * * @ORM\HasLifecycleCallbacks
 */
class Loan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $udatedAt;

    /**
     * @ORM\Column(type="boolean",  nullable=true)
     */
    private $searchable;

    /**
     * @ORM\Column(type="boolean",  nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="loans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Livre::class, inversedBy="loans")
     */
    private $livres;

    /**
     * @ORM\ManyToMany(targetEntity=CDRom::class, inversedBy="loans")
     */
    private $cdrom;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
        $this->cdrom = new ArrayCollection();
    }

       /**
     * perrmet d'initialiser un slug
     * @ORM\PrePersist
     *
     * @return void
     */
    public function initialize()
    {
        //records the current date when a loan is created 
        if (empty($this->createdAt)) {
            $this->createdAt = new \DateTime(); 
        }

        //makes a loan active 
        if (empty($this->status)) {
            $this->status = true; 
        }
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUdatedAt(): ?\DateTimeInterface
    {
        return $this->udatedAt;
    }

    public function setUdatedAt(?\DateTimeInterface $udatedAt): self
    {
        $this->udatedAt = $udatedAt;

        return $this;
    }

    public function getSearchable(): ?bool
    {
        return $this->searchable;
    }

    public function setSearchable(bool $searchable): self
    {
        $this->searchable = $searchable;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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

    /**
     * @return Collection|Livre[]
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        $this->livres->removeElement($livre);

        return $this;
    }

    /**
     * @return Collection|CDRom[]
     */
    public function getCdrom(): Collection
    {
        return $this->cdrom;
    }

    public function addCdrom(CDRom $cdrom): self
    {
        if (!$this->cdrom->contains($cdrom)) {
            $this->cdrom[] = $cdrom;
        }

        return $this;
    }

    public function removeCdrom(CDRom $cdrom): self
    {
        $this->cdrom->removeElement($cdrom);

        return $this;
    }

    public function __toString()
    {
        return $this->cdrom; 
    }

    

   
}