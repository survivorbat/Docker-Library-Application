<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Timestampable\Traits\TimestampableEntity;

class BookExemplar
{
    use TimestampableEntity;

    /** @var string $id */
    private $id = '';
    /** @var int $exemplarNumber */
    private $exemplarNumber = 0;
    /** @var Book|null $book */
    private $book;
    /** @var BookLoan[]|ArrayCollection|array $loans */
    private $loans;
    /** @var Location|null $location */
    private $location;

    /**
     * BookExemplar constructor.
     */
    public function __construct()
    {
        $this->loans = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Book|null
     */
    public function getBook(): ?Book
    {
        return $this->book;
    }

    /**
     * @param Book|null $book
     * @return BookExemplar
     */
    public function setBook(?Book $book): BookExemplar
    {
        $this->book = $book;
        return $this;
    }

    /**
     * @param BookLoan $bookLoan
     * @return BookExemplar
     */
    public function addLoan(BookLoan $bookLoan): BookExemplar
    {
        $this->loans[] = $bookLoan;
        return $this;
    }

    /**
     * @param BookLoan $bookLoan
     * @return BookExemplar
     */
    public function removeLoan(BookLoan $bookLoan): BookExemplar
    {
        $this->loans = array_filter($this->loans, function (BookLoan $bookLoanInList) use ($bookLoan) {
            return $bookLoan !== $bookLoanInList;
        });
        return $this;
    }

    /**
     * @return BookLoan[]|array
     */
    public function getLoans()
    {
        return $this->loans;
    }

    /**
     * @param BookLoan[]|array $loans
     * @return BookExemplar
     */
    public function setLoans($loans)
    {
        $this->loans = $loans;
        return $this;
    }

    /**
     * @return Location|null
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @param Location|null $location
     * @return BookExemplar
     */
    public function setLocation(?Location $location): BookExemplar
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return int
     */
    public function getExemplarNumber(): int
    {
        return $this->exemplarNumber;
    }

    /**
     * @param int $exemplarNumber
     * @return BookExemplar
     */
    public function setExemplarNumber(int $exemplarNumber): BookExemplar
    {
        $this->exemplarNumber = $exemplarNumber;
        return $this;
    }
}
