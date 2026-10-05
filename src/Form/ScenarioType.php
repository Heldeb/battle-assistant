<?php

namespace App\Form;

use App\Entity\Battlefield;
use App\Entity\ExpansionPack;
use App\Entity\Scenario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScenarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('scenario_name', null, [
                'label' => 'Nom du scénario',
            ])
            ->add('date_of_the_battle', null, [
                'label' => 'Date de la bataille',
            ])
            ->add('medal_count', null, [
                'label' => 'Nombre de médailles',
            ])
            ->add('victory_condition', null, [
                'label' => 'Conditions de victoire',
            ])
            ->add('historical_description', null, [
                'label' => 'Description historique',
            ])
            ->add('expansionPack', EntityType::class, [
                'class' => ExpansionPack::class,
                'label' => 'Extension',
                'choice_label' => 'name',
            ])
            ->add('battlefield', EntityType::class, [
                'class' => Battlefield::class,
                'label' => 'Carte',
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Scenario::class,
        ]);
    }
}
