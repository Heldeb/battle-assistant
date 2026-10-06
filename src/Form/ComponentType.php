<?php

namespace App\Form;

use App\Entity\Battlefield;
use App\Entity\Component;
use App\Entity\ExpansionPack;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComponentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('component_name', null, [
                'label' => 'Nom du matériel',
            ])
            ->add('component_type', null, [
                'label' => 'Type de matériel',
            ])
            ->add('component_subcategory', null, [
                'label' => 'Sous-catégorie',
            ])
            ->add('movement_rules', null, [
                'label' => 'Déplacement',
            ])
            ->add('attack_rules', null, [
                'label' => 'Attaques',
            ])
            ->add('protection_rules', null, [
                'label' => 'Protection',
            ])
            ->add('line_of_sight_rules', null, [
                'label' => 'Ligne de mire',
            ])
            ->add('component_icon', null, [
                'label' => 'Photo',
            ])
            ->add('component_side', null, [
                'label' => 'Camp',
            ])
            ->add('component_description', null, [
                'label' => 'Description',
            ])
            ->add('expansion_pack', EntityType::class, [
                'class' => ExpansionPack::class,
                'label' => 'Extension',
                'choice_label' => 'expansion_pack_name',
            ])
            ->add('battlefields', EntityType::class, [
                'class' => Battlefield::class,
                'label' => 'Extension',
                'choice_label' => 'battlefield_type',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Component::class,
        ]);
    }
}
