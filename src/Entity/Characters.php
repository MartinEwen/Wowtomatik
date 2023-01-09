<?php

namespace App\Entity;

use App\Repository\CharactersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharactersRepository::class)]
class Characters
{
    public const ROLE_NONE = 'ROLE_NONE';
    public const ROLE_MEMBER = 'ROLE_MEMBER';
    public const ROLE_OFFICER = 'ROLE_OFFICER';
    public const ROLE_GUILDMASTER = 'ROLE_GUILDMASTER';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nameCharacter = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $lvlCharacter = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $gearScoreSpe1 = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $gearScoreSpe2 = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $roleGuild = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?Guilds $guilds = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $race = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classe $classe = null;

    public function __construct()
    {
        $this->roleGuild = 'ROLE_NONE';
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

    public function getGearScoreSpe1(): ?int
    {
        return $this->gearScoreSpe1;
    }

    public function setGearScoreSpe1(?int $gearScoreSpe1): self
    {
        $this->gearScoreSpe1 = $gearScoreSpe1;

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


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGuilds(): ?Guilds
    {
        return $this->guilds;
    }

    public function setGuilds(?Guilds $guilds): self
    {
        $this->guilds = $guilds;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }
}
