<?php

namespace App\Entity;

use App\Entity\Instances;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BossRepository;

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

    #[ORM\ManyToOne(inversedBy: 'bosses')]
    private ?Instances $instance = null;

    #[ORM\OneToMany(mappedBy: 'boss', targetEntity: Kill::class)]
    private Collection $kills;

    public function __construct()
    {
        $this->kills = new ArrayCollection();
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

    public function getInstance(): ?Instances
    {
        return $this->instance;
    }

    public function setInstance(?Instances $instance): self
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * @return Collection<int, Kill>
     */
    public function getKills(): Collection
    {
        return $this->kills;
    }

    public function addKill(Kill $kill): self
    {
        if (!$this->kills->contains($kill)) {
            $this->kills->add($kill);
            $kill->setBoss($this);
        }

        return $this;
    }

    public function removeKill(Kill $kill): self
    {
        if ($this->kills->removeElement($kill)) {
            // set the owning side to null (unless already changed)
            if ($kill->getBoss() === $this) {
                $kill->setBoss(null);
            }
        }

        return $this;
    }
}
