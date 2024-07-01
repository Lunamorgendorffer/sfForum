<?php

namespace App\Entity;

use App\Repository\TopicRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopicRepository::class)]
class Topic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tite = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $lockTopic = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTite(): ?string
    {
        return $this->tite;
    }

    public function setTite(string $tite): static
    {
        $this->tite = $tite;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isLockTopic(): ?bool
    {
        return $this->lockTopic;
    }

    public function setLockTopic(?bool $lockTopic): static
    {
        $this->lockTopic = $lockTopic;

        return $this;
    }
}
