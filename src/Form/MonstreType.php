<?php

namespace App\Form;

use App\Entity\Hero;
use App\Entity\Monstre;
use App\Entity\Technique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonstreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('pv')
            ->add('attaque')
            ->add('defense')
            ->add('vitesse')
            ->add('Element')
            ->add('techniques', EntityType::class, [
                'class' => Technique::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('heroes', EntityType::class, [
                'class' => Hero::class,
                'choice_label' => 'id',
                'multiple' => true,
                'required' => false
            ])
            ->add('img')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Monstre::class,
        ]);
    }
}
