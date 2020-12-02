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
}
