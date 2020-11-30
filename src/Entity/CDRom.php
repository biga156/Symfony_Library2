<?php

namespace App\Entity;

use App\Repository\CDRomRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Ressource;

/**
 * @ORM\Entity(repositoryClass=CDRomRepository::class)
 */
class CDRom extends Ressource
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
     * @ORM\Column(type="float")
     */
    private $bail;

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

    public function getBail(): ?float
    {
        return $this->bail;
    }

    public function setBail(float $bail): self
    {
        $this->bail = $bail;

        return $this;
    }
}
