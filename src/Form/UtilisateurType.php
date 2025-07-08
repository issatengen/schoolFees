<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeUtilisateur',HiddenType::class,[
                'data'=>'UTS',
                'attr'=>['class'=>'form-control col-md-6']
            ])
            ->add('nomUtilisateur',TextType::class,[
                'attr'=>['class'=>'form-control col-md-4']
            ])
            ->add('prenomUtilisateur',TextType::class,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('EmailUtilisateur',EmailType::class,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('adresseUtilisateur',TextType::class,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('telephoneUtilisateur',TextType::class,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('passwordUtilisateur',PasswordType::class,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('id', EntityType::class, [
                'class' => Role::class,
                'expanded'=> False,
                'multiple'=> False,
                'choice_label' => 'libelleRole',
                'attr'=>['class'=>'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
