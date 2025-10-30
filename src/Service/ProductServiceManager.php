<?php

namespace App\Service;

use App\Entity\ProductService;
use App\Exception\DuplicatedCodeException;
use App\Repository\CategoryRepository;
use App\Repository\ProductServiceRepository;
use App\Repository\TaxConditionRepository;
use App\Repository\UnitMeasureRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductServiceManager
{
    public function __construct(
        private ProductServiceRepository $repo,
        private CategoryRepository $categoryRepository,
        private UnitMeasureRepository $unitMeasureRepository,
        private TaxConditionRepository $taxConditionRepository,
        private EntityManagerInterface $em,
        private ValidatorInterface $validator
    ) {}

    public function create(array $data): ProductService
    {
        if ($this->repo->existsByCode($data['codigo'])) {
            throw new DuplicatedCodeException($data['codigo']);
        }

        $ps = new ProductService();
        $this->map($ps, $data);
        $this->validate($ps);

        $this->em->persist($ps);
        $this->em->flush();

        return $ps;
    }

    public function update(ProductService $ps, array $data): ProductService
    {
        $this->map($ps, $data);
        $this->validate($ps);
        $this->em->flush();
        return $ps;
    }

    private function map(ProductService $ps, array $data): void
    {
        $ps->setCode($data['codigo']);
        $ps->setLabel($data['producto_servicio']);
        $ps->setType($data['tipo']);
        $ps->setGrossPrice($data['precio_bruto_unitario']);

        $ps->setCategory($this->categoryRepository->find($data['rubro']));
        $ps->setUnit($this->unitMeasureRepository->find($data['unidad']));
        $ps->setTaxCondition($this->taxConditionRepository->find($data['condicion_iva']));
    }

    private function validate(ProductService $ps): void
    {
        $errors = $this->validator->validate($ps);
        if (count($errors) > 0) {
            throw new \InvalidArgumentException((string) $errors);
        }
    }
}
