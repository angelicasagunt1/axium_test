<?php

namespace App\Controller;

use App\Entity\TaxCondition;
use App\Form\TaxConditionType;
use App\Repository\TaxConditionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tax/condition')]
final class TaxConditionController extends AbstractController
{
    #[Route(name: 'app_tax_condition_index', methods: ['GET'])]
    public function index(TaxConditionRepository $taxConditionRepository): Response
    {
        return $this->render('tax_condition/index.html.twig', [
            'tax_conditions' => $taxConditionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tax_condition_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $taxCondition = new TaxCondition();
        $form = $this->createForm(TaxConditionType::class, $taxCondition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($taxCondition);
            $entityManager->flush();

            return $this->redirectToRoute('app_tax_condition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tax_condition/new.html.twig', [
            'tax_condition' => $taxCondition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tax_condition_show', methods: ['GET'])]
    public function show(TaxCondition $taxCondition): Response
    {
        return $this->render('tax_condition/show.html.twig', [
            'tax_condition' => $taxCondition,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tax_condition_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TaxCondition $taxCondition, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaxConditionType::class, $taxCondition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tax_condition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tax_condition/edit.html.twig', [
            'tax_condition' => $taxCondition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tax_condition_delete', methods: ['POST'])]
    public function delete(Request $request, TaxCondition $taxCondition, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$taxCondition->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($taxCondition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tax_condition_index', [], Response::HTTP_SEE_OTHER);
    }
}
