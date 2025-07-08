<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Payment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
            'widget' => 'single_text',
            'label' => 'Date de paiement',
            'attr' => [
                'class' => 'form-control',
            ],
            ])
            ->add('amount', null, [
            'label' => 'Montant',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez le montant',
            ],
            ])
            ->add('student', EntityType::class, [
            'class' => Etudiant::class,
            'choice_label' => 'matricule_etudiant',
            'label' => 'Étudiant',
            'attr' => [
                'class' => 'form-select',
            ],
            'placeholder' => 'Sélectionnez un étudiant',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }
}
