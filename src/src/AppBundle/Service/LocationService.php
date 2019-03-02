<?php

namespace AppBundle\Service;

use AppBundle\Entity\Location;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class LocationService
{
    /** @var ObjectRepository $locationRepository */
    private $locationRepository;
    /** @var EntityManagerInterface $em */
    private $em;

    /**
     * LocationService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->locationRepository = $entityManager->getRepository(Location::class);
    }

    /**
     * @return Location[]|array
     */
    public function findAll(): array
    {
        /** @var Location[]|array $locations */
        $locations = $this->locationRepository->findBy([], ['createdAt' => 'DESC']);

        return $locations;
    }

    /**
     * @param Location $location
     */
    public function save(Location $location): void
    {
        $this->em->persist($location);
        $this->em->flush();
    }

    /**
     * @param Location $location
     */
    public function delete(Location $location): void
    {
        $this->em->remove($location);
        $this->em->flush();
    }
}
