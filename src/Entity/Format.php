<?php

namespace App\Entity;

use App\Repository\FormatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormatRepository::class)]
#[UniqueEntity(['width', 'height', 'material'], message: 'Ce format est déjà enregistré!')]
class Format
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'La largeur est obligatoire')]
    private $width;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'La hauteur est obligatoire')]
    private $height;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

    #[Assert\IsTrue(message: 'La hauteur doit être supérieure ou égale à la largeur')]
    public function isValid(): bool
    {
        return $this->getHeight() >= $this->getWidth();
    }

        return $this;
    }
}
