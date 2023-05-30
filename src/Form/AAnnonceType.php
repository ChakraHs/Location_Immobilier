<?php

namespace App\Form;

use App\Entity\AAnnonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('aprix')
            ->add('aville')
            ->add('arue')
            ->add('anumimmo')
            ->add('aetat')
            ->add('atraite')
            ->add('aproprietaire')
            ->add('acategory')
            ->add('aImages',CollectionType::class,[
                'mapped' => false,
                'required' => true,
                'entry_type' => ImageType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('bedrooms')
            ->add('bathrooms')
            ->add('Surface')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AAnnonce::class,
        ]);
    }
}
