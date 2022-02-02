<?php

namespace App\Form;

use App\Entity\Themes;
use App\Entity\Subthemes;
use App\Entity\Ressources;
use App\Service\filtreService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RessourcesType extends AbstractType
{

    public FiltreService $filtreService;


    public function __construct(FiltreService $filtreService)
    {
        $this->filtreService = $filtreService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('themename', EntityType::class, [
            //     'class' => Themes::class,
            //     'mapped' => false
            // ])

            ->add('theme', EntityType::class, [
                'class' => Themes::class,
                'choice_label' => 'name',
                'mapped' => false,
                'placeholder' => "Choisir un thème"
            ])

            // ->add('subtheme', ChoiceType::class, [
            //     'choices' => $this->filtreService->getSubthemes(),
            //     'multiple' => false,
            //     'expanded' => false,
            //     'by_reference' => false,
            //     'placeholder' => "Choisir un sous-thème"
            // ])

            ->add('subtheme', EntityType::class, [
                'class' => Subthemes::class,
                'choice_label' => 'name',
                'placeholder' => "Choisir un sous-thème"

            ])
            ->add('name')
            ->add('level')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Cours' => 'Cours',
                    'Vidéo' => 'Vidéo',
                    'Lien utile' => 'Lien utile'
                    ]
            ])
            ->add('url')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressources::class,
        ]);
    }
}
