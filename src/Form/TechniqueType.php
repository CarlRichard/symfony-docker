<?php

namespace App\Form;

use App\Entity\classe;
use App\Entity\monstre;
use App\Entity\Technique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TechniqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('element')
            ->add('description')
            ->add('effet')
            ->add('classe', EntityType::class, [
                'class' => classe::class,
                'choice_label' => 'id',
            ])
            ->add('joinMonstre', EntityType::class, [
                'class' => monstre::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Technique::class,
        ]);
    }
}
