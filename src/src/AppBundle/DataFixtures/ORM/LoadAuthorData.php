<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class LoadAuthorData extends AbstractFixture implements OrderedFixtureInterface, ORMFixtureInterface
{
    const AMOUNT = 12;

    /** @var Generator $faker */
    private $faker;

    /**
     * LoadAuthorData constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create('nl_NL');
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::AMOUNT + 1; $i++) {
            $author = (new Author())->setName($this->faker->name);

            $this->setReference('author_' . $i, $author);

            $manager->persist($author);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
