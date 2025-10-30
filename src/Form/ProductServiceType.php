<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\ProductService;
use App\Entity\TaxCondition;
use App\Entity\UnitMeasure;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'label' => 'Código',
            ])
            ->add('label', TextType::class, [
                'label' => 'Descripción',
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Tipo',
                'choices' => [
                    'Producto' => 'P',
                    'Servicio' => 'S',
                ],
            ])
            ->add('grossPrice', MoneyType::class, [
                'label' => 'Precio bruto',
                'currency' => 'ARS',
            ])
            ->add('category', EntityType::class, [
                'label' => 'Rubro',
                'class' => Category::class,
                'choice_label' => 'label',
            ])
            ->add('unit', EntityType::class, [
                'label' => 'Unidad',
                'class' => UnitMeasure::class,
                'choice_label' => 'unitMeasure',
            ])
            ->add('taxCondition', EntityType::class, [
                'label' => 'Condición impositiva',
                'class' => TaxCondition::class,
                'choice_label' => 'label',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductService::class,
        ]);
    }
}
