<?php

namespace App\Entity;

use App\Repository\CharactersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharactersRepository::class)]
class Characters
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true, unique: true)]
    private ?string $nameCharacter = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $lvlCharacter = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $classCharacter = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $speCharacter1 = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $gearScoreSpe1 = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $speCharacter2 = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $gearScoreSpe2 = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $roleGuild = null;

    #[ORM\ManyToMany(targetEntity: events::class, inversedBy: 'characters')]
    private Collection $events;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?guilds $guilds = null;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCharacter(): ?string
    {
        return $this->nameCharacter;
    }

    public function setNameCharacter(?string $nameCharacter): self
    {
        $this->nameCharacter = $nameCharacter;

        return $this;
    }

    public function getLvlCharacter(): ?int
    {
        return $this->lvlCharacter;
    }

    public function setLvlCharacter(?int $lvlCharacter): self
    {
        $this->lvlCharacter = $lvlCharacter;

        return $this;
    }

    public function getClassCharacter(): ?string
    {
        return $this->classCharacter;
    }

    public function setClassCharacter(?string $classCharacter): self
    {
        $this->classCharacter = $classCharacter;

        return $this;
    }

    public function getSpeCharacter1(): ?string
    {
        return $this->speCharacter1;
    }

    public function setSpeCharacter1(?string $speCharacter1): self
    {
        $this->speCharacter1 = $speCharacter1;

        return $this;
    }

    public function getGearScoreSpe1(): ?int
    {
        return $this->gearScoreSpe1;
    }

    public function setGearScoreSpe1(?int $gearScoreSpe1): self
    {
        $this->gearScoreSpe1 = $gearScoreSpe1;

        return $this;
    }

    public function getSpeCharacter2(): ?string
    {
        return $this->speCharacter2;
    }

    public function setSpeCharacter2(?string $speCharacter2): self
    {
        $this->speCharacter2 = $speCharacter2;

        return $this;
    }

    public function getGearScoreSpe2(): ?int
    {
        return $this->gearScoreSpe2;
    }

    public function setGearScoreSpe2(?int $gearScoreSpe2): self
    {
        $this->gearScoreSpe2 = $gearScoreSpe2;

        return $this;
    }

    public function getRoleGuild(): ?string
    {
        return $this->roleGuild;
    }

    public function setRoleGuild(?string $roleGuild): self
    {
        $this->roleGuild = $roleGuild;

        return $this;
    }

    /**
     * @return Collection<int, events>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(events $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
        }

        return $this;
    }

    public function removeEvent(events $event): self
    {
        $this->events->removeElement($event);

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGuilds(): ?guilds
    {
        return $this->guilds;
    }

    public function setGuilds(?guilds $guilds): self
    {
        $this->guilds = $guilds;

        return $this;
    }
}
