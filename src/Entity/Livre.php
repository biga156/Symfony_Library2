<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Ressources;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre extends Ressource
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
    private $authtor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $special;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthtor(): ?string
    {
        return $this->authtor;
    }

    public function setAuthtor(string $authtor): self
    {
        $this->authtor = $authtor;

        return $this;
    }

    public function getSpecial(): ?bool
    {
        return $this->special;
    }

    public function setSpecial(bool $special): self
    {
        $this->special = $special;

        return $this;
    }
}
