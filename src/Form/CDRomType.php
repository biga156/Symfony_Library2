<?php

namespace App\Form;

use App\Entity\CDRom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CDRomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('cote')
            ->add('availability')
            ->add('picture')
            ->add('authtor')
            ->add('bail')
            ->add('loans')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CDRom::class,
        ]);
    }
}
