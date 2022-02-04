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
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                'label' => ' ',
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
                'label' => ' ',
                'placeholder' => "Choisir un sous-thème"

            ])
            ->add('name', TextType::class,
            array(
            'attr' => array(
                'placeholder' => 'Nommer la ressource',
            ),
            'label' => ' '))
            ->add('level', TextType::class,
                array(
                'attr' => array(
                    'placeholder' => 'Estimer une note /10',
                ),
                'label' => ' '))
            ->add('type', ChoiceType::class, [
                'label' => ' ',
                'placeholder' => "Choisir un type de ressource",
                'choices' => [
                    'Cours' => 'Cours',
                    'Vidéo' => 'Vidéo',
                    'Lien utile' => 'Lien utile'
                    ]
            ])
            ->add('url',  TextType::class,
            array(
            'attr' => array(
                'placeholder' => "Renseigner l'URL",
            ),
            'label' => ' '))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressources::class,
        ]);
    }
}
