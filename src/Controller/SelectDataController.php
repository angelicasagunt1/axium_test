<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\RubroRepository;
use App\Repository\TaxConditionRepository;
use App\Repository\UnidadMedidaRepository;
use App\Repository\CondicionIvaRepository;
use App\Repository\UnitMeasureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SelectDataController extends AbstractController
{
    #[Route('/rubros', name: 'get_rubros')]
    public function rubros(CategoryRepository $rubroRepository): JsonResponse
    {
        $rubros = $rubroRepository->findAll();
        $data = array_map(fn($rubro) => [
            'id' => $rubro->getId(),
            'nombre' => $rubro->getLabel()
        ], $rubros);

        return $this->json($data);
    }

    #[Route('/unidades', name: 'get_unidades')]
    public function unidades(UnitMeasureRepository $unitRepository): JsonResponse
    {
        $units = $unitRepository->findAll();
        $data = array_map(fn($unit) => [
            'id' => $unit->getId(),
            'nombre' => $unit->getCode()
        ], $units);

        return $this->json($data);
    }

    #[Route('/condiciones_iva', name: 'get_condiciones_iva')]
    public function condicionesIva(TaxConditionRepository $taxConditionRepository): JsonResponse
    {
        $conditions = $taxConditionRepository->findAll();
        $data = array_map(fn($condition) => [
            'id' => $condition->getId(),
            'nombre' => $condition->getLabel()
        ], $conditions);

        return $this->json($data);
    }
}
