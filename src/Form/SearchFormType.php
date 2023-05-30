<?php

namespace App\Form;

use App\model\SearchForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ville',TextType::class,[
                'attr' => [
                    'placeholder' => 'Ville'
                ]
            ])
            ->add('type')
            ->add('prixMax')
            ->add('surfaceMin')
            ->add('chambres')


            
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchForm::class,
            'method'=>'GET',
            'csrf_protection'=>false,
        ]);
    }
}