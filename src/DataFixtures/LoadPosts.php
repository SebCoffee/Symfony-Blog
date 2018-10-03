<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 03/10/18
 * Time: 14:19
 */

namespace App\DataFixtures;


use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPosts extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for($i=0;$i<5;$i++) {

            $post = new Post();

            $post
                ->setTitle($faker->sentence)
                ->setContent(
                    "<p>".join('</p><p>', $faker->paragraphs())."</p>"
                );

            $manager->persist($post);
            $manager->flush();
        }
    }
}