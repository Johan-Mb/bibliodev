<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Themes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ThemeFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->user = $em->getRepository(User::class);
    }

    public const THEMES = [
        ['1', 'PHP', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['1', 'JavaScript', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['1', 'Symfony', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['1', 'React', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['1', 'UX / UI', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['1', 'API', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['1', 'mySQL', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['1', 'CSS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
        ['1', 'Outils', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel fringilla mi, vel laoreet quam.'],
    ];
    public function load(ObjectManager $manager): void
    {

        foreach (self::THEMES as $themeInfos) {
            $theme = new Themes();
            $theme->setUser($this->getReference(UserFixtures::USER_REFERENCE));
            $theme->setName($themeInfos[1]);
            $theme->setDescription($themeInfos[2]);

            $manager->persist($theme);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          UserFixtures::class,
        ];
    }
}
