<?php

namespace AppBundle\Service;

use AppBundle\Entity\BookExemplar;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class BookExemplarService
{
    /** @var ObjectRepository $bookExemplarRepository */
    private $bookExemplarRepository;
    /** @var EntityManagerInterface $em */
    private $em;

    /**
     * BookExemplarService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->bookExemplarRepository = $entityManager->getRepository(BookExemplar::class);
    }

    /**
     * @return BookExemplar[]|array
     */
    public function findAll(): array
    {
        /** @var BookExemplar[]|array $bookExemplars */
        $bookExemplars = $this->bookExemplarRepository->findBy([], ['createdAt' => 'DESC']);

        return $bookExemplars;
    }

    /**
     * @param BookExemplar $bookExemplar
     */
    public function save(BookExemplar $bookExemplar): void
    {
        $this->em->persist($bookExemplar);
        $this->em->flush();
    }

    /**
     * @param BookExemplar $bookExemplar
     */
    public function delete(BookExemplar $bookExemplar): void
    {
        $this->em->remove($bookExemplar);
        $this->em->flush();
    }
}
