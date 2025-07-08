<?php

namespace App\Form;

use App\Entity\Specialite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SpecialiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code_specialite',TextType::class,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('libelle_specialite',TextType::class,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('description',TextType::class,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('fee',IntegerType::class,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('Enregistrer',SubmitType::class,[
                'attr'=>['class'=>'btn btn-success m-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=>Specialite::class,
        ]);
    }
}
