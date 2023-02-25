<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Dishes;
use App\Repository\CategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DishesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', options: [
                'label' => 'Nom du plat',
                'attr' => [
                    'placeholder' => 'Nom du plat'
                ]
            ])
            ->add('description')

            ->add('price', type: MoneyType::class , options: [
                'label' => 'Prix du plat',
                'currency' => 'EUR',

                'attr' => [
                    'placeholder' => 'Prix du plat'
                ]
            ])
            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'name',
                'label' => 'Catégories du plat',
                'group_by' => 'parent.name',
                'query_builder' => function (CategoriesRepository $cr) {
                    return $cr->createQueryBuilder('c')
                        ->where('c.parent IS NULL')
                        ->orderBy('c.name', 'ASC');

                }
                ])
                ->add('images', FileType::class, [
                    'label' => false,
                    'mapped' => false,
                    'required' => false,
                    'multiple' => true,
                    'attr' => [
                        'placeholder' => 'Image du plat'
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dishes::class,
        ]);
    }
}
