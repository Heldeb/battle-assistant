<?php

namespace App\Form;

use App\Entity\ExpansionPack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpansionPack1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('expansion_pack_name', null, [
                'label' => 'Nom de l\'extension',
            ])
            ->add('expansion_pack_icon', null, [
                'label' => 'Photo',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExpansionPack::class,
        ]);
    }
}
