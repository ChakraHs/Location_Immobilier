<?php

namespace App\Form;

use App\model\infoReservation;
use Masterminds\HTML5;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date',DateType::class,[
                'widget' => 'single_text',
                'html5' => true,
                'required' => false,
                'format' => 'yyyy-MM-dd',
            ])
            ->add('nbMois',IntegerType::class,[
                'required' => false,
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => infoReservation::class,
            'method'=>'GET',
            'csrf_protection'=>false,
        ]);
    }
}
