<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
class Piece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $width;

    #[ORM\Column(type: 'integer')]
    private $height;

    #[ORM\Column(type: 'smallint')]
    private $printableFaces;

    #[ORM\Column(type: 'smallint')]
    private $quantity;

    #[ORM\ManyToOne(targetEntity: Material::class, inversedBy: 'pieces')]
    #[ORM\JoinColumn(nullable: false)]
    private $material;

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

        return $this;
    }

    public function getPrintableFaces(): ?int
    {
        return $this->printableFaces;
    }

    public function setPrintableFaces(int $printableFaces): self
    {
        $this->printableFaces = $printableFaces;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): self
    {
        $this->material = $material;

        return $this;
    }
}
