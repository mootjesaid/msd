<?php

namespace App\Entity;

use App\Repository\RoomReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomReservationRepository::class)]
class RoomReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $beginAt = null;

    #[ORM\Column]
    private ?\DateTime $endAt = null;

    #[ORM\ManyToOne(inversedBy: 'spacePlanners')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $PlannedBy = null;

    #[ORM\ManyToOne(inversedBy: 'spacePlanners')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $room = null;

    #[ORM\Column(length: 120)]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeginAt(): ?\DateTime
    {
        return $this->beginAt;
    }

    public function setBeginAt(\DateTime $beginAt): static
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getEndAt(): ?\DateTime
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTime $endAt): static
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getPlannedBy(): ?User
    {
        return $this->PlannedBy;
    }

    public function setPlannedBy(?User $PlannedBy): static
    {
        $this->PlannedBy = $PlannedBy;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): static
    {
        $this->room = $room;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
}
