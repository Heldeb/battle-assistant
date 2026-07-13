<?php

namespace App\Form;

use App\Entity\Battlefield;
use App\Entity\Component;
use App\Entity\ExpansionPack;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BattlefieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('battlefield_type')
            ->add('expansion_pack', EntityType::class, [
                'class' => ExpansionPack::class,
                'choice_label' => 'id',
            ])
            ->add('component', EntityType::class, [
                'class' => Component::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Battlefield::class,
        ]);
    }
}
