<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaiementFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet',TextType::class,[
                'required' => false,
            ])
            ->add('CVV',IntegerType::class,[
                'required' => false,
            ])
            ->add('num',IntegerType::class,[
                'required' => false,
            ])

            ->add('mois',IntegerType::class,[
                'required' => false,
            ])

            ->add('annee',IntegerType::class,[
                'required' => false,
            ])
            ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
