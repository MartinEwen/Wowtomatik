<?php

namespace App\Entity;

use App\Repository\KillRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KillRepository::class)]
#[ORM\Table(name: '`kill`')]
class Kill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $alive = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\ManyToOne(inversedBy: 'boss')]
    private ?Guilds $guild = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'kills')]
    private ?Boss $boss = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAlive(): ?bool
    {
        return $this->alive;
    }

    public function setAlive(?bool $alive): self
    {
        $this->alive = $alive;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getGuild(): ?guilds
    {
        return $this->guild;
    }

    public function setGuild(?guilds $guild): self
    {
        $this->guild = $guild;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBoss(): ?Boss
    {
        return $this->boss;
    }

    public function setBoss(?Boss $boss): self
    {
        $this->boss = $boss;

        return $this;
    }
}
