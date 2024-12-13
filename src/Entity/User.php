<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column]
    private ?int $age = null;

    /**
     * @var Collection<int, Cat>
     */
    #[ORM\ManyToMany(targetEntity: Cat::class, mappedBy: 'adoption')]
    private Collection $cats;

    #[ORM\ManyToOne(inversedBy: 'proprietaire')]
    private ?Maison $maison = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $couple = null;

    /**
     * @var Collection<int, Adopt>
     */
    #[ORM\OneToMany(targetEntity: Adopt::class, mappedBy: 'user')]
    private Collection $adopts;


    public function __construct()
    {
        $this->cats = new ArrayCollection();
        $this->adopts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection<int, Cat>
     */
    public function getCats(): Collection
    {
        return $this->cats;
    }

    public function addCat(Cat $cat): static
    {
        if (!$this->cats->contains($cat)) {
            $this->cats->add($cat);
            $cat->addAdoption($this);
        }

        return $this;
    }

    public function removeCat(Cat $cat): static
    {
        if ($this->cats->removeElement($cat)) {
            $cat->removeAdoption($this);
        }

        return $this;
    }

    public function getMaison(): ?Maison
    {
        return $this->maison;
    }

    public function setMaison(?Maison $maison): static
    {
        $this->maison = $maison;

        return $this;
    }

    public function getCouple(): ?User
    {
        return $this->couple;
    }

    public function setCouple(?User $couple): static
    {
        $this->couple = $couple;

        return $this;
    }

    /**
     * @return Collection<int, Adopt>
     */
    public function getAdopts(): Collection
    {
        return $this->adopts;
    }

    public function addAdopt(Adopt $adopt): static
    {
        if (!$this->adopts->contains($adopt)) {
            $this->adopts->add($adopt);
            $adopt->setUser($this);
        }

        return $this;
    }

    public function removeAdopt(Adopt $adopt): static
    {
        if ($this->adopts->removeElement($adopt)) {
            // set the owning side to null (unless already changed)
            if ($adopt->getUser() === $this) {
                $adopt->setUser(null);
            }
        }

        return $this;
    }


}