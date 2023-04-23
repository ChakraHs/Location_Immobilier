<?php

namespace App\Form;

use App\Entity\AReservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rdateentree')
            ->add('rnombremois')
            ->add('rcontrat')
            ->add('rannonce')
            ->add('rclient')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AReservation::class,
        ]);
    }
}
