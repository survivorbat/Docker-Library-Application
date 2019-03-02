<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\BookLoan;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class LoadLoanData extends AbstractFixture implements OrderedFixtureInterface, ORMFixtureInterface
{
    const AMOUNT = 200;

    /** @var Generator $faker */
    private $faker;

    /**
     * LoadLoanData constructor.
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
            $bookExemplar = $this->getReference('bookExemplar_' . LoadExemplarData::AMOUNT);

            $bookLoan = (new BookLoan())->setBookExemplar($bookExemplar)
                ->setDueDate(new \DateTime('+2 weeks'))
                ->setPastDueFine(0)
                ->setStartDate(new \DateTime())
                ->setMember($this->getReference('member_' . random_int(0, LoadMemberData::AMOUNT)));

            $manager->persist($bookLoan);
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