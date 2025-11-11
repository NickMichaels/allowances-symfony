<?php

namespace App\Entity;

use App\Repository\HolderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HolderRepository::class)]
class Holder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $birthdate = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $rate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $spend_percent = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $save_percent = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $give_percent = null;

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

    public function getBirthdate(): ?\DateTime
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTime $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(?string $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getSpendPercent(): ?string
    {
        return $this->spend_percent;
    }

    public function setSpendPercent(string $spend_percent): static
    {
        $this->spend_percent = $spend_percent;

        return $this;
    }

    public function getSavePercent(): ?string
    {
        return $this->save_percent;
    }

    public function setSavePercent(string $save_percent): static
    {
        $this->save_percent = $save_percent;

        return $this;
    }

    public function getGivePercent(): ?string
    {
        return $this->give_percent;
    }

    public function setGivePercent(string $give_percent): static
    {
        $this->give_percent = $give_percent;

        return $this;
    }
}
