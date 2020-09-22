<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager):void
    {
        $faker = Factory::create();

        $link = (new User())
            ->setUsername('linkmat')
            ->setEmail('linkmat@admin.com')
            ->setRoles(['ROLE_ADMIN']);
        $plain6 = "0000";
        $encode6 = $this->encoder->encodePassword($link, $plain6);
        $link->setPassword($encode6);
        $manager->persist($link);
        $manager->flush();

        for ($i = 0; $i < 50; ++$i) {
            $test = new User();
            $test->setUsername($faker->userName);
            $test->setEmail($faker->email);
            $test->setRoles(['ROLE_USER']);
            $plain2 = "admin";
            $encode2 = $this->encoder->encodePassword($test, $plain2);
            $test->setPassword($encode2);
            $manager->persist($test);
        }


        $user3 = (new User())
            ->setUsername('editeur')
            ->setEmail('editor@admin.com')

            ->setRoles(['ROLE_EDITOR']);
        $plain3 = "admin";
        $encode3 = $this->encoder->encodePassword($user3, $plain3);
        $user3->setPassword($encode3);
        $manager->persist($user3);

        $user4 = (new User())
            ->setUsername('modo')
            ->setEmail('modo@admin.com')
            ->setRoles(['ROLE_MODO']);
        $plain4 = "admin";
        $encode4 = $this->encoder->encodePassword($user4, $plain4);
        $user4->setPassword($encode4);
        $manager->persist($user4);

        $user5 = (new User())
            ->setUsername('linkmat2')
            ->setEmail('linkmat2@admin.com')
            ->setRoles(['ROLE_ADMIN']);
        $plain5 = "admin";
        $encode5 = $this->encoder->encodePassword($user5, $plain5);
        $user5->setPassword($encode5);
        $manager->persist($user5);
        $manager->flush();

        $manager->flush();
    }
}
