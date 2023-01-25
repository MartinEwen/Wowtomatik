<?php

namespace App\Entity;

use App\Entity\Characters;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GuildsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: GuildsRepository::class)]
class Guilds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nameGuild = null;

    #[ORM\OneToMany(mappedBy: 'guilds', targetEntity: Characters::class)]
    private Collection $characters;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'guild', targetEntity: Applicant::class)]
    private Collection $applicant;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->applicant = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Characters>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Characters $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->setGuilds($this);
        }

        return $this;
    }

    public function removeCharacter(Characters $character): self
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getGuilds() === $this) {
                $character->setGuilds(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Collection<int, Applicant>
     */
    public function getApplicant(): Collection
    {
        return $this->applicant;
    }

    public function addApplicant(Applicant $applicant): self
    {
        if (!$this->applicant->contains($applicant)) {
            $this->applicant->add($applicant);
            $applicant->setGuild($this);
        }

        return $this;
    }

    public function removeApplicant(Applicant $applicant): self
    {
        if ($this->applicant->removeElement($applicant)) {
            // set the owning side to null (unless already changed)
            if ($applicant->getGuild() === $this) {
                $applicant->setGuild(null);
            }
        }

        return $this;
    }
}
