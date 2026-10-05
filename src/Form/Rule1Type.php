<?php

namespace App\Form;

use App\Entity\Rule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Rule1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rule_type', null, [
                'label' => 'Type de règle',
            ])
            ->add('rule_step', null, [
                'label' => 'Etape de la règle',
            ])
            ->add('rule_name', null, [
                'label' => 'Nom de la règle',
            ])
            ->add('rule_description', null, [
                'label' => 'Description de la règle',
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rule::class,
        ]);
    }
}
