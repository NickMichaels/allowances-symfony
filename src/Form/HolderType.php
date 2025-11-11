<?php

namespace App\Form;

use App\Entity\Holder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('birthdate')
            ->add('age')
            ->add('rate')
            ->add('spend_percent')
            ->add('save_percent')
            ->add('give_percent')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Holder::class,
        ]);
    }
}
