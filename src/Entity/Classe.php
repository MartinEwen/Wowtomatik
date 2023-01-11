<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\ManyToMany(targetEntity: Race::class, inversedBy: 'classes')]
    private Collection $race;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Characters::class)]
    private Collection $characters;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Specialisation::class)]
    private Collection $specialisations;

    public function __construct()
    {
        $this->race = new ArrayCollection();
        $this->characters = new ArrayCollection();
        $this->specialisations = new ArrayCollection();
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
     * @return Collection<int, race>
     */
    public function getRace(): Collection
    {
        return $this->race;
    }

    public function addRace(race $race): self
    {
        if (!$this->race->contains($race)) {
            $this->race->add($race);
        }

        return $this;
    }

    public function removeRace(race $race): self
    {
        $this->race->removeElement($race);

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
            $character->setClasse($this);
        }

        return $this;
    }

    public function removeCharacter(characters $character): self
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getClasse() === $this) {
                $character->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Specialisation>
     */
    public function getSpecialisations(): Collection
    {
        return $this->specialisations;
    }

    public function addSpecialisation(Specialisation $specialisation): self
    {
        if (!$this->specialisations->contains($specialisation)) {
            $this->specialisations->add($specialisation);
            $specialisation->setClasse($this);
        }

        return $this;
    }

    public function removeSpecialisation(Specialisation $specialisation): self
    {
        if ($this->specialisations->removeElement($specialisation)) {
            // set the owning side to null (unless already changed)
            if ($specialisation->getClasse() === $this) {
                $specialisation->setClasse(null);
            }
        }

        return $this;
    }
}
