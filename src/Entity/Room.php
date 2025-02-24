<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    /**
     * @var Collection<int, RoomReservation>
     */
    #[ORM\OneToMany(targetEntity: RoomReservation::class, mappedBy: 'room')]
    private Collection $spacePlanners;

    public function __construct()
    {
        $this->spacePlanners = new ArrayCollection();
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

    public function __toString(): string
    {
        $className = (new \ReflectionClass($this))->getShortName();

        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $className));
    }

    /**
     * @return Collection<int, RoomReservation>
     */
    public function getSpacePlanners(): Collection
    {
        return $this->spacePlanners;
    }

    public function addSpacePlanner(RoomReservation $spacePlanner): static
    {
        if (!$this->spacePlanners->contains($spacePlanner)) {
            $this->spacePlanners->add($spacePlanner);
            $spacePlanner->setRoom($this);
        }

        return $this;
    }

    public function removeSpacePlanner(RoomReservation $spacePlanner): static
    {
        if ($this->spacePlanners->removeElement($spacePlanner)) {
            // set the owning side to null (unless already changed)
            if ($spacePlanner->getRoom() === $this) {
                $spacePlanner->setRoom(null);
            }
        }

        return $this;
    }
}
