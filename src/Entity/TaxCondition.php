<?php

namespace App\Entity;

use App\Repository\TaxConditionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\TaxConditionRepository")]
#[ORM\Table(name: "condicion_iva")]
#[ORM\UniqueConstraint(name: "condicion_iva_codigo_ux", columns: ["codigo"])]
#[ORM\UniqueConstraint(name: "condicion_iva_ux", columns: ["condicion_iva"])]

class TaxCondition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_condicion_iva", type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "codigo", type: "smallint")]
    private int $code;

    #[ORM\Column(name: "condicion_iva", type: "string", length: 50)]
    private string $label;

    #[ORM\Column(name: "alicuota", type: "decimal", precision: 10, scale: 3)]
    private string $rate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getRate(): string
    {
        return $this->rate;
    }

    public function setRate(string $rate): self
    {
        $this->rate = $rate;
        return $this;
    }
}
