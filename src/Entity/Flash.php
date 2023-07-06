<?php

namespace App\Entity;

use App\Repository\FlashRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: FlashRepository::class)]
#[UniqueEntity(
    fields: ['flashUser', 'spaceInvader'],
    message: 'This Space Invader has already been flashed by that user.',
    errorPath: 'spaceInvader',
)]
class Flash
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'flashes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $flashUser = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $flashDate = null;

    #[ORM\ManyToOne(inversedBy: 'flashes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SpaceInvader $spaceInvader = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlashUser(): ?User
    {
        return $this->flashUser;
    }

    public function setFlashUser(?User $flashUser): static
    {
        $this->flashUser = $flashUser;

        return $this;
    }

    public function getFlashDate(): ?\DateTimeInterface
    {
        return $this->flashDate;
    }

    public function setFlashDate(?\DateTimeInterface $flashDate): static
    {
        $this->flashDate = $flashDate;

        return $this;
    }

    public function getSpaceInvader(): ?SpaceInvader
    {
        return $this->spaceInvader;
    }

    public function setSpaceInvader(?SpaceInvader $spaceInvader): static
    {
        $this->spaceInvader = $spaceInvader;

        return $this;
    }
}
