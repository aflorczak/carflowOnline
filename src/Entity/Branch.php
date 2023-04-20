<?php

namespace App\Entity;

use App\Repository\BranchRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BranchRepository::class)]
class Branch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $addressFirstLine = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addressSecondLine = null;

    #[ORM\Column(length: 50)]
    private ?string $postCode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $cars = [];

    #[ORM\Column(length: 255)]
    private ?string $imgSrc = null;

    #[ORM\Column(length: 255)]
    private ?string $navLink = null;

    #[ORM\Column(length: 500)]
    private ?string $mapLink = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 30)]
    private ?string $phone = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAddressFirstLine(): ?string
    {
        return $this->addressFirstLine;
    }

    public function setAddressFirstLine(string $addressFirstLine): self
    {
        $this->addressFirstLine = $addressFirstLine;

        return $this;
    }

    public function getAddressSecondLine(): ?string
    {
        return $this->addressSecondLine;
    }

    public function setAddressSecondLine(?string $addressSecondLine): self
    {
        $this->addressSecondLine = $addressSecondLine;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCars(): array
    {
        return $this->cars;
    }

    public function setCars(array $cars): self
    {
        $this->cars = $cars;

        return $this;
    }

    public function getImgSrc(): ?string
    {
        return $this->imgSrc;
    }

    public function setImgSrc(string $imgSrc): self
    {
        $this->imgSrc = $imgSrc;

        return $this;
    }

    public function getNavLink(): ?string
    {
        return $this->navLink;
    }

    public function setNavLink(string $navLink): self
    {
        $this->navLink = $navLink;

        return $this;
    }

    public function getMapLink(): ?string
    {
        return $this->mapLink;
    }

    public function setMapLink(string $mapLink): self
    {
        $this->mapLink = $mapLink;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
