<?php

namespace App\Entity;

use App\Repository\SpaceInvaderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: SpaceInvaderRepository::class)]
#[UniqueEntity('name')]
#[UniqueEntity(
    fields: ['area', 'number'],
    errorPath: 'number',
    message: 'There is already a SI with this number on that area.'
)]
class SpaceInvader
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'spaceInvaders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Area $area = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $position = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comments = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgSrc = null;

    #[ORM\OneToMany(mappedBy: 'spaceInvader', targetEntity: Flash::class, orphanRemoval: true)]
    private Collection $flashes;

    public function __construct()
    {
        $this->flashes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getArea(): ?Area
    {
        return $this->area;
    }

    public function setArea(?Area $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): static
    {
        $this->comments = $comments;

        return $this;
    }

    public function getImgSrc(): ?string
    {
        return $this->imgSrc;
    }

    public function setImgSrc(?string $imgSrc): static
    {
        $this->imgSrc = $imgSrc;

        return $this;
    }

    /**
     * @return Collection<int, Flash>
     */
    public function getFlashes(): Collection
    {
        return $this->flashes;
    }

    public function addFlash(Flash $flash): static
    {
        if (!$this->flashes->contains($flash)) {
            $this->flashes->add($flash);
            $flash->setSpaceInvader($this);
        }

        return $this;
    }

    public function removeFlash(Flash $flash): static
    {
        if ($this->flashes->removeElement($flash)) {
            // set the owning side to null (unless already changed)
            if ($flash->getSpaceInvader() === $this) {
                $flash->setSpaceInvader(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
