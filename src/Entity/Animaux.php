<?php

namespace App\Entity;

use App\Repository\AnimauxRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnimauxRepository::class)]
class Animaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $race;

    #[Assert\Positive(message: "Le nombre de pattes doit être positif.")]
    #[ORM\Column(type: 'integer')]
    private $nbDePattes;

    #[ORM\Column(type: 'boolean')]
    private $isCarnivore;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getNbDePattes(): ?int
    {
        return $this->nbDePattes;
    }

    public function setNbDePattes(int $nbDePattes): self
    {
        $this->nbDePattes = $nbDePattes;

        return $this;
    }

    public function getIsCarnivore(): ?bool
    {
        return $this->isCarnivore;
    }

    public function setIsCarnivore(bool $isCarnivore): self
    {
        $this->isCarnivore = $isCarnivore;

        return $this;
    }
}
