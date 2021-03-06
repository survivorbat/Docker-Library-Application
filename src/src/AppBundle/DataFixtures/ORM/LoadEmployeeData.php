<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\Employee;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Location;
use AppBundle\Entity\Member;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class LoadEmployeeData extends AbstractFixture implements OrderedFixtureInterface, ORMFixtureInterface
{
    const AMOUNT = 15;

    /** @var Generator $faker */
    private $faker;
    /** @var BCryptPasswordEncoder $bcrypt */
    private $bcrypt;

    /**
     * LoadBookData constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create('nl_NL');
        $this->bcrypt = new BCryptPasswordEncoder(12);
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
            /** @var Location $location */
            $location = $this->getReference('location_' . random_int(0, LoadLocationData::AMOUNT));

            $employee = (new Employee())->setFirstName($this->faker->firstName)
                ->setLastName($this->faker->lastName)
                ->setUsername($this->faker->userName)
                ->setPassword($this->bcrypt->encodePassword('test', ''))
                ->setEmail($this->faker->email)
                ->setPhoneNumber($this->faker->phoneNumber)
                ->setLocation($location);

            $this->setReference('employee_' . $i, $employee);

            $manager->persist($employee);
            $manager->flush();
        }

        /** @var Location $location */
        $location = $this->getReference('location_' . random_int(0, LoadLocationData::AMOUNT));

        $admin = (new Employee())
            ->setUsername('admin')
            ->setPassword($this->bcrypt->encodePassword('admin', ''))
            ->setLocation($location)
            ->setEmail($this->faker->email)
            ->setFirstName($this->faker->firstName)
            ->setLastName($this->faker->lastName)
            ->setPhoneNumber($this->faker->phoneNumber);

        $manager->persist($admin);

        $manager->flush();
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
