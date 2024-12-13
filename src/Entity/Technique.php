<?php

namespace App\Entity;

use App\Repository\TechniqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TechniqueRepository::class)]
class Technique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $element = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $effet = null;

    #[ORM\ManyToOne(inversedBy: 'techniques')]
    private ?Classe $classe = null;

    /**
     * @var Collection<int, Monstre>
     */
    #[ORM\ManyToMany(targetEntity: Monstre::class, inversedBy: 'techniques')]
    private Collection $joinMonstre;

    public function __construct()
    {
        $this->joinMonstre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getElement(): ?string
    {
        return $this->element;
    }

    public function setElement(?string $element): static
    {
        $this->element = $element;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEffet(): ?string
    {
        return $this->effet;
    }

    public function setEffet(?string $effet): static
    {
        $this->effet = $effet;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection<int, Monstre>
     */
    public function getJoinMonstre(): Collection
    {
        return $this->joinMonstre;
    }

    public function addJoinMonstre(Monstre $joinMonstre): static
    {
        if (!$this->joinMonstre->contains($joinMonstre)) {
            $this->joinMonstre->add($joinMonstre);
        }

        return $this;
    }

    public function removeJoinMonstre(Monstre $joinMonstre): static
    {
        $this->joinMonstre->removeElement($joinMonstre);

        return $this;
    }
}
