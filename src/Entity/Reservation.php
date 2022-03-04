<?php

namespace App\Entity;

use App\Enum\ReservationStatus;
use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[Assert\NotBlank(message: 'La date de livraison est obligatoire')]
    private $deliveryDate;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank(message: 'Le numéro de dossier est obligatoire')]
    #[Assert\Regex('/^[A-Z]{2}2[0-9]{3}-[0-9]{3} [A-Z]{1,3} [1-9A-Z]{2,3}$/', message: 'Format invalide')]
    private $jobId;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: 'Le client est obligatoire')]
    private $jobCustomer;

    #[ORM\Column(type: 'string', length: 50)]
    private $userIdentifier;

    #[ORM\Column(type: 'smallint')]
    private $status;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $statusComment;

    public function __construct(UserInterface $user)
    {
        $this->userIdentifier = $user->getUserIdentifier();
        $this->setDefaults();
    }

    private function setDefaults()
    {
        $this->setCreationTime(new \DateTime('NOW'));
        $this->setStatus(ReservationStatus::CREATION->getValue());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationTime(): ?\DateTimeInterface
    {
        return $this->creationTime;
    }

    public function getCreationTimeLabel(): string
    {
        return $this->getCreationTime()->format('d/m/Y');
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

    public function getDeliveryDateLabel(): string
    {
        return $this->getDeliveryDate()->format('d/m');
    }

    public function setDeliveryDate(?\DateTimeInterface $deliveryDate): self
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

    public function getStatusLabel(): string
    {
        return ReservationStatus::from($this->getStatus())->getLabel();
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
