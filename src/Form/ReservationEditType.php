<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'deliveryDate',
                DateType::class,
                [
                    'label' => 'Date de départ',
                    'widget' => 'single_text'
                ]
            )->add(
                'jobId',
                TextType::class,
                [
                    'label' => 'Numéro de dossier',
                    'help' => 'Exemple: PA2102-004 A COV'
                ]
            )->add('jobCustomer', TextType::class, ['label' => 'Nom du client'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
