<?php

namespace AppBundle\Service;

use AppBundle\Entity\Book;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class BookService
{
    /** @var ObjectRepository $bookRepository */
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
        /** @var Book[]|array $books */
        $books =  $this->bookRepository->findBy([], ['createdAt' => 'DESC']);

        return $books;
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
