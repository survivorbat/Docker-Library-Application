<?php

namespace AppBundle\Service;

use AppBundle\Entity\BookLoan;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookLoanService
{
    /** @var ObjectRepository $bookLoanRepository */
    private $bookLoanRepository;
    /** @var EntityManagerInterface $em */
    private $em;

    /**
     * BookLoanService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->bookLoanRepository = $entityManager->getRepository(BookLoan::class);
    }

    /**
     * @return BookLoan[]|array
     */
    public function findAll(): array
    {
        /** @var BookLoan[]|array $bookLoans */
        $bookLoans = $this->bookLoanRepository->findBy([], ['startDate' => 'DESC']);

        return $bookLoans;
    }

    /**
     * @param BookLoan $bookLoan
     */
    public function save(BookLoan $bookLoan): void
    {
        $this->em->persist($bookLoan);
        $this->em->flush();
    }

    /**
     * @param BookLoan $bookLoan
     */
    public function delete(BookLoan $bookLoan): void
    {
        $this->em->remove($bookLoan);
        $this->em->flush();
    }
}
