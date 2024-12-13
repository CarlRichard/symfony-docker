<?php

namespace App\Entity;

use App\Repository\CatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatRepository::class)]
class Cat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;


    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?string $race = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'cats')]
    private Collection $adoption;

    /**
     * @var Collection<int, Adopt>
     */
    #[ORM\OneToMany(targetEntity: Adopt::class, mappedBy: 'cat')]
    private Collection $adopts;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img = null;

    public function __construct()
    {
        $this->adoption = new ArrayCollection();
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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): static
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAdoption(): Collection
    {
        return $this->adoption;
    }

    public function addAdoption(User $adoption): static
    {
        if (!$this->adoption->contains($adoption)) {
            $this->adoption->add($adoption);
        }

        return $this;
    }

    public function removeAdoption(User $adoption): static
    {
        $this->adoption->removeElement($adoption);

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
            $adopt->setCat($this);
        }

        return $this;
    }

    public function removeAdopt(Adopt $adopt): static
    {
        if ($this->adopts->removeElement($adopt)) {
            // set the owning side to null (unless already changed)
            if ($adopt->getCat() === $this) {
                $adopt->setCat(null);
            }
        }

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

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