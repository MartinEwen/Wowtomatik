<?php

namespace App\Form;

use App\Entity\Race;
use App\Entity\Classe;
use App\Entity\Characters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CharactersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $form = $builder;
        $form
            ->add('nameCharacter')
            ->add('lvlCharacter')
            ->add('race', ChoiceType::class, [
                'choices' => $options['races'],
                'choice_label' => 'name',
                'choice_value' => 'id',
                'required' => false,
                'attr' => [
                    'id' => 'race-select',
                ],
                'placeholder' => 'Sélectionnez une race',
            ])
            ->add('classe', ChoiceType::class, [
                'choices' => $options['classes'],
                'choice_label' => 'name',
                'choice_value' => 'id',
                'required' => false,
                'attr' => [
                    'id' => 'classe-select',
                ],
                'placeholder' => 'Sélectionnez d\'abord une race',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Characters::class,
            'races' => [],
            'classes' => [],
        ]);
    }
}
