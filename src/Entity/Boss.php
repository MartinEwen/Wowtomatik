<?php

namespace App\Entity;

use App\Repository\BossRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BossRepository::class)]
class Boss
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameBoss = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgBoss = null;

    #[ORM\ManyToMany(targetEntity: Guilds::class, mappedBy: 'boss')]
    private Collection $guilds;

    #[ORM\ManyToMany(targetEntity: Instances::class, mappedBy: 'boss')]
    private Collection $instances;

    public function __construct()
    {
        $this->guilds = new ArrayCollection();
        $this->instances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameBoss(): ?string
    {
        return $this->nameBoss;
    }

    public function setNameBoss(?string $nameBoss): self
    {
        $this->nameBoss = $nameBoss;

        return $this;
    }

    public function getImgBoss(): ?string
    {
        return $this->imgBoss;
    }

    public function setImgBoss(?string $imgBoss): self
    {
        $this->imgBoss = $imgBoss;

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
            $guild->addBoss($this);
        }

        return $this;
    }

    public function removeGuild(Guilds $guild): self
    {
        if ($this->guilds->removeElement($guild)) {
            $guild->removeBoss($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Instances>
     */
    public function getInstances(): Collection
    {
        return $this->instances;
    }

    public function addInstance(Instances $instance): self
    {
        if (!$this->instances->contains($instance)) {
            $this->instances->add($instance);
            $instance->addBoss($this);
        }

        return $this;
    }

    public function removeInstance(Instances $instance): self
    {
        if ($this->instances->removeElement($instance)) {
            $instance->removeBoss($this);
        }

        return $this;
    }
}
