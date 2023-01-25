<?php

namespace App\Entity;

use App\Repository\ApplicantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantRepository::class)]
class Applicant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $accept = null;

    #[ORM\ManyToOne(inversedBy: 'applicant')]
    private ?Guilds $guild = null;

    #[ORM\ManyToOne(inversedBy: 'applicant')]
    private ?Characters $characters = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAccept(): ?bool
    {
        return $this->accept;
    }

    public function setAccept(bool $accept): self
    {
        $this->accept = $accept;

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

    public function getCharacters(): ?characters
    {
        return $this->characters;
    }

    public function setCharacters(?characters $characters): self
    {
        $this->characters = $characters;

        return $this;
    }
}
