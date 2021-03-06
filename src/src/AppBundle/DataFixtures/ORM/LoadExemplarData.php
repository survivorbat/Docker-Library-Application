<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Book;
use AppBundle\Entity\BookExemplar;
use AppBundle\Entity\Location;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class LoadExemplarData extends AbstractFixture implements OrderedFixtureInterface, ORMFixtureInterface
{
    const AMOUNT = 40;

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
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::AMOUNT + 1; $i++) {
            /** @var Book $book */
            $book = $this->getReference('book_' . random_int(0, LoadBookData::AMOUNT));
            /** @var Location $location */
            $location = $this->getReference('location_' . random_int(0, LoadLocationData::AMOUNT));

            $bookExemplar = (new BookExemplar())->setBook($book)
                ->setLocation($location)
                ->setExemplarNumber($this->faker->numberBetween(0, 60000));

            $this->setReference('bookExemplar_' . $i, $bookExemplar);

            $manager->persist($bookExemplar);
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
        return 3;
    }
}
