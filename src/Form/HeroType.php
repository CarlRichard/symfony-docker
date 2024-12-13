<?php

namespace App\Form;

use App\Entity\classe;
use App\Entity\Hero;
use App\Entity\monstre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('pv')
            ->add('attaque')
            ->add('defense')
            ->add('vitesse')
            ->add('classe', EntityType::class, [
                'class' => classe::class,
                'choice_label' => 'id',
            ])
            ->add('combat', EntityType::class, [
                'class' => monstre::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hero::class,
        ]);
    }
}
