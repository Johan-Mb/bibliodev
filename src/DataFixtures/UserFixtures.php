<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $user = new Users();
        $user->setName("Johan MABIT");
        $user->setEmail("johan.mabit@gmail.com");
        $user->setPassword("Motdepasse1");
        $manager->persist($user);

        $otherUser = new Users();
        $otherUser->setName("Karl MORISSET");
        $otherUser->setEmail("karl.morisset@gmail.com");
        $otherUser->setPassword("Motdepasse2");
        $manager->persist($otherUser);

        $manager->flush();
    }

}
