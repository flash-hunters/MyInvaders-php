<?php

namespace App\Entity;

use App\Repository\AreaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: AreaRepository::class)]
#[UniqueEntity('name')]
#[UniqueEntity('code')]
class Area
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'area', targetEntity: SpaceInvader::class, orphanRemoval: true)]
    #[ORM\OrderBy(["name" => "ASC"])]
    private Collection $spaceInvaders;

    public function __construct()
    {
        $this->spaceInvaders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, SpaceInvader>
     */
    public function getSpaceInvaders(): Collection
    {
        return $this->spaceInvaders;
    }

    public function addSpaceInvader(SpaceInvader $spaceInvader): static
    {
        if (!$this->spaceInvaders->contains($spaceInvader)) {
            $this->spaceInvaders->add($spaceInvader);
            $spaceInvader->setArea($this);
        }

        return $this;
    }

    public function removeSpaceInvader(SpaceInvader $spaceInvader): static
    {
        if ($this->spaceInvaders->removeElement($spaceInvader)) {
            // set the owning side to null (unless already changed)
            if ($spaceInvader->getArea() === $this) {
                $spaceInvader->setArea(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return ($this->name)." (".($this->code).")";
    }
}
