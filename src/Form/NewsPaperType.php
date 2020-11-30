<?php

namespace App\Form;

use App\Entity\NewsPaper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsPaperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('cote')
            ->add('availability')
            ->add('picture')
            ->add('createdAt')
            ->add('loans')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewsPaper::class,
        ]);
    }
}
