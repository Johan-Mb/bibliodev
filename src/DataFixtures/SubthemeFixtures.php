<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Themes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SubthemeFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->themes = $em->getRepository(Themes::class);
    }

    public const SUBTHEMES = [
        ['1', 'Doctrine', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['2', 'Commandes de bases', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['3', 'Security', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['4', 'Tableaux et boucles', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
    ];
    public function load(ObjectManager $manager): void
    {

        foreach (self::SUBTHEMES as $subthemeInfos) {
            $subtheme = new Subthemes();
            $subtheme->setTheme($this->getReference(ThemeFixtures::THEMES_REFERENCE));
            $subtheme->setName($subthemeInfos[1]);
            $subtheme->setDescription($subthemeInfos[2]);

            $manager->persist($subtheme);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          UserFixtures::class,
          ThemeFixtures::class,
        ];
    }
}
