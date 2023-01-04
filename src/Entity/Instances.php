<?php

namespace App\Entity;

use App\Entity\Guilds;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\InstancesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: InstancesRepository::class)]
class Instances
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameInstance = null;

    #[ORM\ManyToMany(targetEntity: Guilds::class, mappedBy: 'instances')]
    private Collection $guilds;

    #[ORM\OneToMany(mappedBy: 'instance', targetEntity: Boss::class)]
    private Collection $bosses;

    public function __construct()
    {
        $this->guilds = new ArrayCollection();
        $this->bosses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameInstance(): ?string
    {
        return $this->nameInstance;
    }

    public function setNameInstance(?string $nameInstance): self
    {
        $this->nameInstance = $nameInstance;

        return $this;
    }

    /**
     * @return Collection<int, Guilds>
     */
    public function getGuilds(): Collection
    {
        return $this->guilds;
    }

    public function addGuild(Guilds $guild): self
    {
        if (!$this->guilds->contains($guild)) {
            $this->guilds->add($guild);
            $guild->addInstance($this);
        }

        return $this;
    }

    public function removeGuild(Guilds $guild): self
    {
        if ($this->guilds->removeElement($guild)) {
            $guild->removeInstance($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Boss>
     */
    public function getBosses(): Collection
    {
        return $this->bosses;
    }
}
