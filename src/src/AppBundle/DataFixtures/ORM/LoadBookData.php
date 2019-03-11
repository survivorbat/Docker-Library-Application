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

class LoadBookData extends AbstractFixture implements OrderedFixtureInterface, ORMFixtureInterface
{
    const AMOUNT = 15;
    const TITLES = [
        'Het zwaard van Damocles',
        'Beste Vriend',
        'Echt Sexy',
        'Boy 7',
        'Het verraad van Fortuin',
        'Donald Duck - #77',
        'Anne Frank',
        'Het huis Anubis',
        'Het geheim van de schatkist',
        'Doctor Who - Het laatste hoofdstuk',
        'Het kruis van de tempeliers',
        'Het meisje met de groene ogen',
        'Fifty shades of grey',
        'Computerhandboek, derde editie',
        'Mijn vader en zij',
        'De vlucht',
    ];

    /** @var Generator $faker */
    private $faker;

    /**
     * LoadBookData constructor.
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
            /** @var Author $author */
            $author = $this->getReference('author_' . random_int(0, LoadAuthorData::AMOUNT));

            $book = (new Book())->setTitle(self::TITLES[$i])
                ->setDescription($this->faker->realText(300))
                ->setAuthor($author)
                ->setGenres($this->getRandomAmountOfGenres(3));

            $this->setReference('book_' . $i, $book);

            $manager->persist($book);
        }

        $manager->flush();
    }

    /**
     * @param int $max
     * @return Genre[]|array
     * @throws \Exception
     */
    private function getRandomAmountOfGenres(int $max): array
    {
        $genres = [];

        for ($i = 0; $i < random_int(0, $max); $i++) {
            /** @var Genre $genre */
            $genre = $this->getReference('genre_' . random_int(0, LoadGenreData::AMOUNT));

            in_array($genre, $genres) ?: $genres[] = $genre;
        }

        return $genres;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
