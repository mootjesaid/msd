<?php

namespace App\Entity;

use App\Repository\EventRoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRoomRepository::class)]
class EventRoom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

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
}
