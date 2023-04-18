<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $clientsData = null;

    #[ORM\Column(length: 50)]
    private ?string $principal = null;

    #[ORM\Column(length: 255)]
    private ?string $internalCaseNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $externalCaseNumber = null;

    #[ORM\Column(length: 50)]
    private ?string $proposedSegment = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryAddress = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $deliveryDate = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $deliveryTime = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryComments = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryBranch = null;

    #[ORM\Column(length: 255)]
    private ?string $returnedAddress = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $returnedDate = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $returnedTime = null;

    #[ORM\Column(length: 255)]
    private ?string $returnedComments = null;

    #[ORM\Column(length: 255)]
    private ?string $returnedBranch = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $reasonForCancellingTheOrder = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getClientsData(): ?string
    {
        return $this->clientsData;
    }

    public function setClientsData(string $clientsData): self
    {
        $this->clientsData = $clientsData;

        return $this;
    }

    public function getPrincipal(): ?string
    {
        return $this->principal;
    }

    public function setPrincipal(string $principal): self
    {
        $this->principal = $principal;

        return $this;
    }

    public function getInternalCaseNumber(): ?string
    {
        return $this->internalCaseNumber;
    }

    public function setInternalCaseNumber(string $internalCaseNumber): self
    {
        $this->internalCaseNumber = $internalCaseNumber;

        return $this;
    }

    public function getExternalCaseNumber(): ?string
    {
        return $this->externalCaseNumber;
    }

    public function setExternalCaseNumber(string $externalCaseNumber): self
    {
        $this->externalCaseNumber = $externalCaseNumber;

        return $this;
    }

    public function getProposedSegment(): ?string
    {
        return $this->proposedSegment;
    }

    public function setProposedSegment(string $proposedSegment): self
    {
        $this->proposedSegment = $proposedSegment;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(string $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getDeliveryTime(): ?\DateTimeInterface
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(\DateTimeInterface $deliveryTime): self
    {
        $this->deliveryTime = $deliveryTime;

        return $this;
    }

    public function getDeliveryComments(): ?string
    {
        return $this->deliveryComments;
    }

    public function setDeliveryComments(string $deliveryComments): self
    {
        $this->deliveryComments = $deliveryComments;

        return $this;
    }

    public function getDeliveryBranch(): ?string
    {
        return $this->deliveryBranch;
    }

    public function setDeliveryBranch(string $deliveryBranch): self
    {
        $this->deliveryBranch = $deliveryBranch;

        return $this;
    }

    public function getReturnedAddress(): ?string
    {
        return $this->returnedAddress;
    }

    public function setReturnedAddress(string $returnedAddress): self
    {
        $this->returnedAddress = $returnedAddress;

        return $this;
    }

    public function getReturnedDate(): ?\DateTimeInterface
    {
        return $this->returnedDate;
    }

    public function setReturnedDate(\DateTimeInterface $returnedDate): self
    {
        $this->returnedDate = $returnedDate;

        return $this;
    }

    public function getReturnedTime(): ?\DateTimeInterface
    {
        return $this->returnedTime;
    }

    public function setReturnedTime(\DateTimeInterface $returnedTime): self
    {
        $this->returnedTime = $returnedTime;

        return $this;
    }

    public function getReturnedComments(): ?string
    {
        return $this->returnedComments;
    }

    public function setReturnedComments(string $returnedComments): self
    {
        $this->returnedComments = $returnedComments;

        return $this;
    }

    public function getReturnedBranch(): ?string
    {
        return $this->returnedBranch;
    }

    public function setReturnedBranch(string $returnedBranch): self
    {
        $this->returnedBranch = $returnedBranch;

        return $this;
    }

    public function getReasonForCancellingTheOrder(): ?string
    {
        return $this->reasonForCancellingTheOrder;
    }

    public function setReasonForCancellingTheOrder(string $reasonForCancellingTheOrder): self
    {
        $this->reasonForCancellingTheOrder = $reasonForCancellingTheOrder;

        return $this;
    }
}
