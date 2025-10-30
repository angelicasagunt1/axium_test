<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: "App\Repository\ProductServiceRepository")]
#[ORM\Table(name: "producto_servicio")]
#[UniqueEntity(fields: ['code'], message: 'Este código ya está en uso.', errorPath: 'code')]
class ProductService
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column(name: "id_producto_servicio", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "codigo", type: "string", length: 20, unique: true)]
    #[Assert\NotBlank(message: 'El código es obligatorio.')]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9]+$/',
        message: 'El código solo puede contener letras y números.'
    )]
    private string $code;

    #[ORM\Column(name: "producto_servicio", type: "string", length: 255)]
    #[Assert\NotBlank(message: 'La descripción es obligatoria.')]
    private string $label;

    #[ORM\Column(name: "tipo", type: "string", length: 1)]
    #[Assert\NotBlank(message: 'Debe seleccionar un tipo.')]
    #[Assert\Choice(choices: ['P', 'S'], message: 'El tipo debe ser P (Producto) o S (Servicio).')]
    private string $type;

    #[ORM\Column(name: "precio_bruto_unitario", type: "decimal", precision: 30, scale: 2)]
    #[Assert\NotBlank(message: 'El precio bruto no puede estar vacío.')]
    #[Assert\Positive(message: 'El precio debe ser un número positivo.')]
    #[Assert\Type(type: 'numeric', message: 'El precio debe ser un valor numérico.')]
    private ?float $grossPrice = null;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(name: "id_rubro", referencedColumnName: "id_rubro", nullable: false)]
    #[Assert\NotNull(message: 'Debe seleccionar un rubro.')]
    private Category $category;

    #[ORM\ManyToOne(targetEntity: UnitMeasure::class)]
    #[ORM\JoinColumn(name: "id_unidad_medida", referencedColumnName: "id_unidad_medida", nullable: false)]
    #[Assert\NotNull(message: 'Debe seleccionar una unidad de medida.')]
    private UnitMeasure $unit;

    #[ORM\ManyToOne(targetEntity: TaxCondition::class)]
    #[ORM\JoinColumn(name: "id_condicion_iva", referencedColumnName: "id_condicion_iva", nullable: false)]
    #[Assert\NotNull(message: 'Debe seleccionar una condición de IVA.')]
    private TaxCondition $taxCondition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getGrossPrice(): string
    {
        return $this->grossPrice;
    }

    public function setGrossPrice(float $grossPrice): void
    {
        $this->grossPrice = $grossPrice;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getUnit(): UnitMeasure
    {
        return $this->unit;
    }

    public function setUnit(UnitMeasure $unit): void
    {
        $this->unit = $unit;
    }

    public function getTaxCondition(): TaxCondition
    {
        return $this->taxCondition;
    }

    public function setTaxCondition(TaxCondition $taxCondition): void
    {
        $this->taxCondition = $taxCondition;
    }
}