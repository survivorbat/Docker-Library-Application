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

class LoadGenreData extends AbstractFixture implements OrderedFixtureInterface, ORMFixtureInterface
{
    const GENRES = [
        'Horror',
        'Comedie',
        'Romantiek',
        'Misdaad',
        'Actie',
        'Paranormaal',
        'Pornografie',
        'Superhelden',
        'Kinderen',
        'Animatie',
        'Holebi',
    ];
    const AMOUNT = 10;

    /** @var Generator $faker */
    private $faker;

    /**
     * LoadGenreData constructor.
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
            $genre = (new Genre())->setTitle(self::GENRES[$i])
                ->setDescription($this->faker->realText(200));

            $this->setReference('genre_' . $i, $genre);

            $manager->persist($genre);
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
