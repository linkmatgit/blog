<?php

namespace App\DataFixtures;

use App\Entity\Blog\Category;
use App\Entity\Blog\Post;
use App\Entity\Trick\Trick;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $cat = new Category();
        $faker = Factory::create();
        for ($i = 0; $i < 50; ++$i) {
            $data = (new Post())
            ->setContent($faker->text(2000))
            ->setSlug($faker->slug(3))
            ->setTitle($faker->sentence(6))
            ->setCreatedAt($faker->dateTime)
            ->setIsOnline(true);
        $manager->persist($data);
    }

        for ($i = 0; $i < 50; ++$i) {
            $data2 = (new Category())
                ->setContent($faker->sentence)
                ->setSlug($faker->slug(3))
                ->setTitle($faker->sentence(6))
                ->setCreatedAt($faker->dateTime)
                ->setIsOnline(true)
                ->setColor($faker->hexColor);
            $manager->persist($data2);
        }

        for ($i = 0; $i < 100; ++$i) {
            $data3 = (new Trick())
                ->setContent($faker->sentence)
                ->setSlug($faker->slug(3))
                ->setTitle($faker->sentence(6))
                ->setCreatedAt($faker->dateTime)
                ->setIsOnline(true)
                ->setYoutubeId($faker->uuid);
            $manager->persist($data3);
        }
        $manager->flush();


    }
}
