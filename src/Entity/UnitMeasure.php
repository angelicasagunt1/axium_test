<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\UnitMeasureRepository")]
#[ORM\Table(name: "unidad_medida")]
#[ORM\UniqueConstraint(name: "unidad_medida_codigo_ux", columns: ["codigo"])]
#[ORM\UniqueConstraint(name: "unidad_medida_ux", columns: ["unidad_medida"])]

class UnitMeasure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_unidad_medida", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "codigo", type: "string", length: 5)]
    private string $code;

    #[ORM\Column(name: "unidad_medida", type: "string", length: 50)]
    private string $unitMeasure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getUnitMeasure(): string
    {
        return $this->unitMeasure;
    }

    public function setUnitMeasure(string $unitMeasure): self
    {
        $this->unitMeasure = $unitMeasure;
        return $this;
    }
}
