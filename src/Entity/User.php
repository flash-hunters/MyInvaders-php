<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\OneToMany(mappedBy: 'flashUser', targetEntity: Flash::class, orphanRemoval: true)]
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

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
            $flash->setFlashUser($this);
        }

        return $this;
    }

    public function removeFlash(Flash $flash): static
    {
        if ($this->flashes->removeElement($flash)) {
            // set the owning side to null (unless already changed)
            if ($flash->getFlashUser() === $this) {
                $flash->setFlashUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
