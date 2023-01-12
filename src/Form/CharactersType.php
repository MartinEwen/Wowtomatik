<?php

namespace App\Form;

use App\Entity\Race;
use App\Entity\Classe;
use App\Entity\Characters;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Test\FormInterface;

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
                'placeholder' => 'Race disponible',
            ])
            ->add('classe', ChoiceType::class, [
                'placeholder' => 'classe dispo',

            ])
            // ->add('classe', EntityType::class, [
            //     'class' => Classe::class,
            //     'choice_label' => 'name',
            //     'required' => true,
            //     'placeholder' => 'classe dispo'
            // ])
        ;


        $formModifier = function (FormInterface $form, Race $race = null) {
            $classe = (null === $race) ? [] : $race->getClasses();

            $form->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choices' => $classe,
                'choice_label' => 'name',
                'placeholder' => 'classe dispo',
                'label' => 'classe'
            ]);
        };

        $builder->get('race')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $race = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $race);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Characters::class,
        ]);
    }
}
