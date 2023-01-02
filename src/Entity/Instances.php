<?php

namespace App\Entity;

use App\Repository\InstancesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstancesRepository::class)]
class Instances
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameInstance = null;

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
}
