<?php

namespace App\Entity;

use App\Enum\PiecePrintableFaces;
use App\Repository\PieceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
#[UniqueEntity(['width', 'height', 'printableFaces', 'material'], message: 'Ce format de chute existe déjà!')]
class Piece
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

    #[ORM\Column(type: 'smallint')]
    private $printableFaces;

    #[ORM\Column(type: 'smallint')]
    #[Assert\NotBlank(message: 'La quantité est obligatoire')]
    private $quantity;

    #[ORM\ManyToOne(targetEntity: Material::class, inversedBy: 'pieces')]
    #[ORM\JoinColumn(nullable: false)]
    private $material;

    public function __construct(Material $material)
    {
        $this->setMaterial($material);
    }

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

    public function getPrintableFacesLabel(): string
    {
        return PiecePrintableFaces::from($this->getPrintableFaces())->getLabel();
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

    public function getDisplayName(): string
    {
        return sprintf('%s X %s mm', $this->getWidth(), $this->getHeight());
    }

    #[Assert\IsTrue(message: 'La hauteur doit être supérieure ou égale à la largeur')]
    public function isValid(): bool
    {
        return $this->getHeight() >= $this->getWidth();
    }
}
