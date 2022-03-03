<?php

namespace App\Form;

use App\Entity\Piece;
use App\Enum\PiecePrintableFaces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PieceEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('width', TextType::class, ['label' => 'Largeur'])
            ->add('height', TextType::class, ['label' => 'Hauteur'])
            ->add(
                'printableFaces',
                ChoiceType::class,
                [
                    'label' => 'Faces exploitables',
                    'choices' => PiecePrintableFaces::getFormChoices(),
                ]
            )->add('quantity', NumberType::class, ['label' => 'Quantité'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Piece::class,
        ]);
    }
}
