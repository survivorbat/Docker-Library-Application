<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Location;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class LoadLocationData extends AbstractFixture implements OrderedFixtureInterface, ORMFixtureInterface
{
    const AMOUNT = 5;

    /** @var Generator $faker */
    private $faker;

    /**
     * LoadLocationData constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create('nl_NL');
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::AMOUNT + 1; $i++) {
            $location = (new Location())->setName($this->faker->word)
                ->setAddress($this->faker->address)
                ->setCity($this->faker->city)
                ->setOpeningDate($this->faker->dateTimeBetween('-10 years', '-1 years'))
                ->setPostalCode($this->faker->postcode);

            $this->setReference('location_' . $i, $location);

            $manager->persist($location);
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
