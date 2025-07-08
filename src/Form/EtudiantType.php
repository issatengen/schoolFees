<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Specialite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//           ->add('id_etudiant')
            // ->add('matricule_etudiant',TextType::class,[
            //     'attr'=>['class' =>'form-control']
            // ])
            ->add('nom_etudiant',TextType::class,[
                'attr'=>['class'=>'form-control col-md-5'],
                'label'=>'Student Name',
            ]) 
            ->add('prenom_etudiant',TextType::class,[
                'attr'=>['class'=>'form-control col-md-7'],
                'label'=>'Student First Name'
            ])
            ->add('date_naissance', DateType::class,[
                'attr'=>['class'=>'form-control col-md-7'],
                'label'=>'Date of Birth'
            ])
            ->add('code_specialite',EntityType::class,[
                'attr'=>['class'=>'form-control'],
                'class'=>Specialite::class,
                'choice_label'=>'libelle_specialite',
//                'placeholder'=>'Sellectionner une specialite',
                'expanded'=>false,
                'multiple'=>false,
                'label'=>'Speciality',
            ])
            ->add('Enregistrer',SubmitType::class,[
                'attr'=>['class'=>'btn btn-success mt-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
