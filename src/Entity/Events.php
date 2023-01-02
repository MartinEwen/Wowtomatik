<?php

namespace App\Entity;

use App\Repository\EventsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventsRepository::class)]
class Events
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameEvent = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nameUserCreator = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEvent = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $numberOfTank = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $numberOfHeal = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $numberOfDps = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEvent(): ?string
    {
        return $this->nameEvent;
    }

    public function setNameEvent(?string $nameEvent): self
    {
        $this->nameEvent = $nameEvent;

        return $this;
    }

    public function getNameUserCreator(): ?string
    {
        return $this->nameUserCreator;
    }

    public function setNameUserCreator(?string $nameUserCreator): self
    {
        $this->nameUserCreator = $nameUserCreator;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(?\DateTimeInterface $dateEvent): self
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    public function getNumberOfTank(): ?int
    {
        return $this->numberOfTank;
    }

    public function setNumberOfTank(?int $numberOfTank): self
    {
        $this->numberOfTank = $numberOfTank;

        return $this;
    }

    public function getNumberOfHeal(): ?int
    {
        return $this->numberOfHeal;
    }

    public function setNumberOfHeal(?int $numberOfHeal): self
    {
        $this->numberOfHeal = $numberOfHeal;

        return $this;
    }

    public function getNumberOfDps(): ?int
    {
        return $this->numberOfDps;
    }

    public function setNumberOfDps(?int $numberOfDps): self
    {
        $this->numberOfDps = $numberOfDps;

        return $this;
    }
}
