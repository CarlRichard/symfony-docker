<?php

namespace App\Entity;

use App\Repository\MaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaisonRepository::class)]
class Maison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $adress = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'maison')]
    private Collection $proprietaire;

    public function __construct()
    {
        $this->proprietaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getProprietaire(): Collection
    {
        return $this->proprietaire;
    }

    public function addProprietaire(User $proprietaire): static
    {
        if (!$this->proprietaire->contains($proprietaire)) {
            $this->proprietaire->add($proprietaire);
            $proprietaire->setMaison($this);
        }

        return $this;
    }

    public function removeProprietaire(User $proprietaire): static
    {
        if ($this->proprietaire->removeElement($proprietaire)) {
            // set the owning side to null (unless already changed)
            if ($proprietaire->getMaison() === $this) {
                $proprietaire->setMaison(null);
            }
        }

        return $this;
    }

}