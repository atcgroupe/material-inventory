<?php

namespace App\Form;

use App\Entity\Format;
use App\Enum\FormatPriority;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormatEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('width', NumberType::class, ['label' => 'Largeur', 'help' => 'Petit coté, en mm'])
            ->add('height', NumberType::class, ['label' => 'Hauteur', 'help' => 'Grand coté, en mm'])
            ->add(
                'priority',
                ChoiceType::class,
                [
                    'label' => 'Type',
                    'choices' => FormatPriority::getFormChoices(),
                ],
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Format::class,
        ]);
    }
}
