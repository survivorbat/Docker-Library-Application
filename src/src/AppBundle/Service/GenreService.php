<?php

namespace AppBundle\Service;

use AppBundle\Entity\Genre;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class GenreService
{
    /** @var ObjectRepository $genreRepository */
    private $genreRepository;
    /** @var EntityManagerInterface $em */
    private $em;

    /**
     * GenreService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->genreRepository = $entityManager->getRepository(Genre::class);
    }

    /**
     * @return Genre[]|array
     */
    public function findAll(): array
    {
        /** @var Genre[]|array $genres */
        $genres = $this->genreRepository->findBy([], ['createdAt' => 'DESC']);

        return $genres;
    }

    /**
     * @param Genre $genre
     */
    public function save(Genre $genre): void
    {
        $this->em->persist($genre);
        $this->em->flush();
    }

    /**
     * @param Genre $genre
     */
    public function delete(Genre $genre): void
    {
        $this->em->remove($genre);
        $this->em->flush();
    }
}
