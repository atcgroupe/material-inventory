<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $creationTime;

    #[ORM\Column(type: 'date')]
    private $deliveryDate;

    #[ORM\Column(type: 'string', length: 20)]
    private $jobId;

    #[ORM\Column(type: 'string', length: 100)]
    private $jobCustomer;

    #[ORM\Column(type: 'string', length: 50)]
    private $userIdentifier;

    #[ORM\Column(type: 'smallint')]
    private $status;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $statusComment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationTime(): ?\DateTimeInterface
    {
        return $this->creationTime;
    }

    public function setCreationTime(\DateTimeInterface $creationTime): self
    {
        $this->creationTime = $creationTime;

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

    public function getJobId(): ?string
    {
        return $this->jobId;
    }

    public function setJobId(string $jobId): self
    {
        $this->jobId = $jobId;

        return $this;
    }

    public function getJobCustomer(): ?string
    {
        return $this->jobCustomer;
    }

    public function setJobCustomer(string $jobCustomer): self
    {
        $this->jobCustomer = $jobCustomer;

        return $this;
    }

    public function getUserIdentifier(): ?string
    {
        return $this->userIdentifier;
    }

    public function setUserIdentifier(string $userIdentifier): self
    {
        $this->userIdentifier = $userIdentifier;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatusComment(): ?string
    {
        return $this->statusComment;
    }

    public function setStatusComment(?string $statusComment): self
    {
        $this->statusComment = $statusComment;

        return $this;
    }
}
