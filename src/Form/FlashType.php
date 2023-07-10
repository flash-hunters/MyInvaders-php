<?php

namespace App\Form;

use App\Entity\Flash;
use App\Entity\SpaceInvader;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlashType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('flashUser', EntityType::class, [
                'class' => User::class,
                'placeholder' => '------',
                'autocomplete' => true,
            ])
            ->add('spaceInvader', EntityType::class, [
                'class' => SpaceInvader::class,
                'placeholder' => '------',
                'autocomplete' => true,
            ])
            ->add('flashDate', DateTimeType::class, [
                'widget' => 'single_text',
                'with_seconds' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Flash::class,
        ]);
    }
}
