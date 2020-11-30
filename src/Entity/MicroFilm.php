<?php

namespace App\Entity;

use App\Repository\MicroFilmRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Ressource;

/**
 * @ORM\Entity(repositoryClass=MicroFilmRepository::class)
 */
class MicroFilm extends Ressource
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
