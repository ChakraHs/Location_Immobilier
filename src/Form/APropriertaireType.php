<?php

namespace App\Form;

use App\Entity\AProprietaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class APropriertaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pnom',TextType::class,[
                'label' => 'Nom',
            ] )
            ->add('pprenom',TextType::class,[
                'label' => 'Prénom',
            ] )
            ->add('ptele',TextType::class,[
                'label' => 'Téléphone',
            ] )
            ->add('pcin',TextType::class,[
                'label' => 'CIN',
            ] )
            ->add('pcinimage',FileType::class,[
                'label' => 'Carte Nationnale',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        // 'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid pdf',
                    ])
                ],
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AProprietaire::class,
        ]);
    }
}
