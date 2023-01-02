<?php

namespace App\Entity;

use App\Repository\BossRepository;
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
}
