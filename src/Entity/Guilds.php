<?php

namespace App\Entity;

use App\Repository\GuildsRepository;
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
}
