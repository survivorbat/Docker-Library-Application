<?php

namespace AppBundle\Service;

use AppBundle\Entity\Book;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class BookService
{
    /** @var EntityRepository $bookRepository */
    private $bookRepository;
    /** @var EntityManagerInterface $em */
    private $em;

    /**
     * BookService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->bookRepository = $entityManager->getRepository(Book::class);
    }

    /**
     * @return Book[]|array
     */
    public function findAll(): array
    {
        return $this->bookRepository->findAll();
    }

    /**
     * @param Book $book
     */
    public function save(Book $book): void
    {
        $this->em->persist($book);
        $this->em->flush();
    }

    /**
     * @param Book $book
     */
    public function delete(Book $book): void
    {
        $this->em->remove($book);
        $this->em->flush();
    }
}