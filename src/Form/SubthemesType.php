<?php

namespace App\Form;

use App\Entity\Themes;
use App\Entity\Subthemes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SubthemesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('theme', EntityType::class, [
                'class' => Themes::class,
                'choice_label' => 'name',
                'label' => ' '
            ])
            ->add('name', TextType::class,
            array(
            'attr' => array(
                'placeholder' => 'Nommer le sous-thème',
            ),
            'label' => ' '))
            ->add('description', TextType::class,
            array(
            'attr' => array(
                'placeholder' => 'Décrire le sous-thème',
            ),
            'label' => ' '))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subthemes::class,
        ]);
    }
}
