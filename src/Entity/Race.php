<?php

namespace App\Entity;

use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaceRepository::class)]
class Race
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\OneToMany(mappedBy: 'race', targetEntity: Characters::class)]
    private Collection $characters;

    #[ORM\ManyToMany(targetEntity: Classe::class, mappedBy: 'race')]
    private Collection $classes;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, characters>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(characters $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->setRace($this);
        }

        return $this;
    }

    public function removeCharacter(characters $character): self
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getRace() === $this) {
                $character->setRace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->addRace($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            $class->removeRace($this);
        }

        return $this;
    }
}
