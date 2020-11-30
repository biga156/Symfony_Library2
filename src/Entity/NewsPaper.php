<?php

namespace App\Entity;

use App\Repository\NewsPaperRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Ressources;


/**
 * @ORM\Entity(repositoryClass=NewsPaperRepository::class)
 */
class NewsPaper extends Ressource 
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
}
