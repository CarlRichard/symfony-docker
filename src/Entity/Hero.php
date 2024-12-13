<?php

namespace App\Entity;

use App\Repository\HeroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HeroRepository::class)]
class Hero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $pv = null;

    #[ORM\Column]
    private ?int $attaque = null;

    #[ORM\Column]
    private ?int $defense = null;

    #[ORM\Column]
    private ?int $vitesse = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Classe $classe = null;

    /**
     * @var Collection<int, Objet>
     */
    #[ORM\OneToMany(targetEntity: Objet::class, mappedBy: 'hero')]
    private Collection $objet;

    /**
     * @var Collection<int, Monstre>
     */
    #[ORM\ManyToMany(targetEntity: Monstre::class, inversedBy: 'heroes')]
    private Collection $combat;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img = null;

    public function __construct()
    {
        // Initialisation des collections
        $this->objet = new ArrayCollection();
        $this->combat = new ArrayCollection();
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

    public function getPv(): ?int
    {
        return $this->pv;
    }

    public function setPv(int $pv): static
    {
        $this->pv = $pv;
        return $this;
    }

    public function getAttaque(): ?int
    {
        return $this->attaque;
    }

    public function setAttaque(int $attaque): static
    {
        $this->attaque = $attaque;
        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): static
    {
        $this->defense = $defense;
        return $this;
    }

    public function getVitesse(): ?int
    {
        return $this->vitesse;
    }

    public function setVitesse(int $vitesse): static
    {
        $this->vitesse = $vitesse;
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
     * @return Collection<int, Objet>
     */
    public function getObjet(): Collection
    {
        return $this->objet;
    }

    public function addObjet(Objet $objet): static
    {
        if (!$this->objet->contains($objet)) {
            $this->objet->add($objet);
            $objet->setHero($this);
        }
        return $this;
    }

    public function removeObjet(Objet $objet): static
    {
        if ($this->objet->removeElement($objet)) {
            if ($objet->getHero() === $this) {
                $objet->setHero(null);
            }
        }
        return $this;
    }
    

    /**
     * @return Collection<int, Monstre>
     */
    public function getCombat(): Collection
    {
        return $this->combat;
    }

    public function addCombat(Monstre $combat): static
    {
        if (!$this->combat->contains($combat)) {
            $this->combat->add($combat);
        }
        return $this;
    }

    public function removeCombat(Monstre $combat): static
    {
        $this->combat->removeElement($combat);
        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): static
    {
        $this->img = $img;

        return $this;
    }
}
