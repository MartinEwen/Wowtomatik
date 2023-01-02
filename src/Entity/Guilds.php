<?php

namespace App\Entity;

use App\Repository\GuildsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuildsRepository::class)]
class Guilds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nameGuild = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberOfMember = null;

    #[ORM\OneToMany(mappedBy: 'guilds', targetEntity: Characters::class)]
    private Collection $characters;

    #[ORM\OneToMany(mappedBy: 'guilds', targetEntity: events::class)]
    private Collection $events;

    #[ORM\ManyToMany(targetEntity: instances::class, inversedBy: 'guilds')]
    private Collection $instances;

    #[ORM\ManyToMany(targetEntity: boss::class, inversedBy: 'guilds')]
    private Collection $boss;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->instances = new ArrayCollection();
        $this->boss = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameGuild(): ?string
    {
        return $this->nameGuild;
    }

    public function setNameGuild(?string $nameGuild): self
    {
        $this->nameGuild = $nameGuild;

        return $this;
    }

    public function getNumberOfMember(): ?int
    {
        return $this->numberOfMember;
    }

    public function setNumberOfMember(?int $numberOfMember): self
    {
        $this->numberOfMember = $numberOfMember;

        return $this;
    }

    /**
     * @return Collection<int, Characters>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Characters $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->setGuilds($this);
        }

        return $this;
    }

    public function removeCharacter(Characters $character): self
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getGuilds() === $this) {
                $character->setGuilds(null);
            }
        }

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
            $event->setGuilds($this);
        }

        return $this;
    }

    public function removeEvent(events $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getGuilds() === $this) {
                $event->setGuilds(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, instances>
     */
    public function getInstances(): Collection
    {
        return $this->instances;
    }

    public function addInstance(instances $instance): self
    {
        if (!$this->instances->contains($instance)) {
            $this->instances->add($instance);
        }

        return $this;
    }

    public function removeInstance(instances $instance): self
    {
        $this->instances->removeElement($instance);

        return $this;
    }

    /**
     * @return Collection<int, boss>
     */
    public function getBoss(): Collection
    {
        return $this->boss;
    }

    public function addBoss(boss $boss): self
    {
        if (!$this->boss->contains($boss)) {
            $this->boss->add($boss);
        }

        return $this;
    }

    public function removeBoss(boss $boss): self
    {
        $this->boss->removeElement($boss);

        return $this;
    }
}
