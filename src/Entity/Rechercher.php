<?php

namespace App\Entity;

class Rechercher
{

    /**
     *
     * @var string|null
     */
    private $titre;

    /**
     *
     * @var string|null
     */
    private $cote;

     /**
     *
     * @var string|null
     */
    private $author;


    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    } 

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCote(): ?string
    {
        return $this->cote;
    } 

    public function setCote(?string $cote): self
    {
        $this->cote = $cote;

        return $this;
    }
}
