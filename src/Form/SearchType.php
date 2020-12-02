<?php

namespace App\Form;

use App\Entity\Rechercher;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Titre du livre'
                ]
            ] )
            ->add('author',TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'nom de auteur'
                ]
            ] )

           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rechercher::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
