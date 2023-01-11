<?php

namespace App\Form;

use App\Entity\Race;
use App\Entity\Classe;
use App\Entity\Characters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CharactersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameCharacter')
            ->add('lvlCharacter')
            ->add('race', EntityType::class, [
                'class' => Race::class,
                'choice_label' => 'name',
                'required' => true,
                'placeholder' => 'Race disponible'
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                // 'choice' => $classe,
                'choice_label' => 'name',
                'placeholder' => 'Classe (choisir une Race)',
                'label' => 'classe',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Characters::class,
        ]);
    }
}
