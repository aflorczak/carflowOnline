<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 50)]
    private ?string $brand = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 50)]
    private ?string $model = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 50)]
    private ?string $vin = null;

    #[Assert\NotBlank]
    #[ORM\Column]
    private ?int $mileage = null;

    #[Assert\NotBlank]
    #[ORM\Column]
    private ?int $numberOfSeats = null;

    #[Assert\NotBlank]
    #[ORM\Column]
    private ?int $numberOfDoors = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 50)]
    private ?string $fuel = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 50)]
    private ?string $bodyType = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 50)]
    private ?string $segment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): self
    {
        $this->vin = $vin;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): self
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getNumberOfSeats(): ?int
    {
        return $this->numberOfSeats;
    }

    public function setNumberOfSeats(int $numberOfSeats): self
    {
        $this->numberOfSeats = $numberOfSeats;

        return $this;
    }

    public function getNumberOfDoors(): ?int
    {
        return $this->numberOfDoors;
    }

    public function setNumberOfDoors(int $numberOfDoors): self
    {
        $this->numberOfDoors = $numberOfDoors;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getBodyType(): ?string
    {
        return $this->bodyType;
    }

    public function setBodyType(string $bodyType): self
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    public function getSegment(): ?string
    {
        return $this->segment;
    }

    public function setSegment(string $segment): self
    {
        $this->segment = $segment;

        return $this;
    }
}
