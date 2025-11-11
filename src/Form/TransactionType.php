<?php

namespace App\Form;

use App\Entity\Account;
use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Enum\TransactionType as EnumTransactionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage as TranslatableMessage;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('transaction_type', EnumType::class, [
                'class' => EnumTransactionType::class,
                // Optional: Custom label for each choice
                'choice_label' => fn (EnumTransactionType $choice) => new TranslatableMessage(
                    $choice->name, 
                    [],
                    'form' // Translation domain
                ),

                'placeholder' => 'Choose an transaction type',
            ])
            ->add('amount')
            ->add('date')
            ->add('memo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
