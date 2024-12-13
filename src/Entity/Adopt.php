<?php

namespace App\Entity;

use App\Repository\AdoptRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdoptRepository::class)]
class Adopt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'adopts')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'adopts')]
    private ?Cat $cat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_adoption = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCat(): ?Cat
    {
        return $this->cat;
    }

    public function setCat(?Cat $cat): static
    {
        $this->cat = $cat;

        return $this;
    }

    public function getDateAdoption(): ?\DateTimeInterface
    {
        return $this->date_adoption;
    }

    public function setDateAdoption(\DateTimeInterface $date_adoption): static
    {
        $this->date_adoption = $date_adoption;

        return $this;
    }
}
