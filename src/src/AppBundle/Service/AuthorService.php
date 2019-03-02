<?php

namespace AppBundle\Service;

use AppBundle\Entity\Author;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class AuthorService
{
    /** @var ObjectRepository $authorRepository */
    private $authorRepository;
    /** @var EntityManagerInterface $em */
    private $em;

    /**
     * AuthorService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->authorRepository = $entityManager->getRepository(Author::class);
    }

    /**
     * @return Author[]|array
     */
    public function findAll(): array
    {
        /** @var Author[]|array $authors */
        $authors = $this->authorRepository->findBy([], ['createdAt' => 'DESC']);

        return $authors;
    }

    /**
     * @param Author $book
     */
    public function save(Author $book): void
    {
        $this->em->persist($book);
        $this->em->flush();
    }

    /**
     * @param Author $book
     */
    public function delete(Author $book): void
    {
        $this->em->remove($book);
        $this->em->flush();
    }
}
