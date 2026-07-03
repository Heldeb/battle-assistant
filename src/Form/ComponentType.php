<?php

namespace App\Form;

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
            ->add('component_name')
            ->add('component_type')
            ->add('subcategory')
            ->add('movement_rules')
            ->add('attack_rules')
            ->add('protection_rules')
            ->add('line_of_sight_rules')
            ->add('component_icon')
            ->add('side')
            ->add('expansion_pack', EntityType::class, [
                'class' => ExpansionPack::class,
                'choice_label' => 'id',
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
