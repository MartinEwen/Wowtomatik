<?php

namespace App\Form;

use App\Entity\Race;
use App\Entity\Classe;
use App\Entity\Characters;
use Doctrine\ORM\EntityRepository;
use App\Repository\ClasseRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('race', EntityType::class, [
                'class' => Race::class, // va chercher dans la table "Race"
                'choice_label' => 'name', // va chercher dans l'entité "name"
                'choice_value' => 'id',
                'label_attr' => ['class' => 'sr-only'],
                'required' => true,
                'placeholder' => 'Race disponible',
            ])

            ->add('classe', ChoiceType::class, [
                'placeholder' => 'classe dispo',

            ]);


        $formModifier = function (FormInterface $form, Race $race = null) {
            $classe = (null === $race) ? [] : $race->getClasses();
            // recupere les classes liée à la race selectionner 

            $form->add('classe', EntityType::class, [
                'class' => Classe::class, // va chercher dans la table "Classe"
                'choice_label' => 'name', // va chercher dans l'entité "name"
                'choices' => $classe, // va chercher les réponce recuperer avec getClasses() ??? 
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
