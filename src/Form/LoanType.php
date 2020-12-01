<?php

namespace App\Form;

use App\Entity\Loan;
use App\Entity\User;
use App\Entity\CDRom;
use App\Entity\Livre;
use App\Repository\CDRomRepository;;

use App\Repository\LivreRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => function ($user) {
                    return $user->getFirstName();
                }
            ]) 

            ->add('livres', EntityType::class, [
                'class' => Livre::class,
                'query_builder' => function (LivreRepository $livre) {
                    return $livre->createQueryBuilder('l')
                        ->andWhere('l.availability = :val')
                        ->setParameter('val', true)
                        ->orderBy('l.title', 'ASC');
                },
                'choice_label' =>  function (Livre $livre) {
                    return sprintf('(%d)- %s : %s',
                    $livre -> getId(),
                    $livre -> getAuthtor(),
                    $livre -> getTitle()
                );
                },
                //TODO: array collection?
                //'choice_value' => ,
                'placeholder' => 'aucun',
                'required' => false,
                
            ])



            ->add('cdrom', EntityType::class, [
                'class' => CDRom::class,
                'query_builder' => function (CDRomRepository $cdrom) {
                    return $cdrom->createQueryBuilder('c')
                        ->andWhere('c.availability = :val')
                        ->setParameter('val', true)
                        ->orderBy('c.title', 'ASC');
                },
                'choice_label' => 'title',
            

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Loan::class,
        ]);
    }
}
