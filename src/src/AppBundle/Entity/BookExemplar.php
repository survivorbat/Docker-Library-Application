<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Timestampable\Traits\TimestampableEntity;

class BookExemplar
{
    use TimestampableEntity;

    /** @var string $id */
    private $id = '';
    /** @var Book|null $book */
    private $book;
    /** @var BookLoan[]|array $pastLoans */
    private $pastLoans;
    /** @var BookLoan|null $currentLoan */
    private $currentLoan;
    /** @var Location|null $location */
    private $location;

    /**
     * BookExemplar constructor.
     */
    public function __construct()
    {
        $this->pastLoans = new ArrayCollection();
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
    public function addPastLoan(BookLoan $bookLoan): BookExemplar
    {
        $this->pastLoans[] = $bookLoan;
        return $this;
    }

    /**
     * @param BookLoan $bookLoan
     * @return BookExemplar
     */
    public function removePastLoan(BookLoan $bookLoan): BookExemplar
    {
        $this->pastLoans = array_filter($this->pastLoans, function (BookLoan $bookLoanInList) use ($bookLoan) {
            return $bookLoan !== $bookLoanInList;
        });
        return $this;
    }

    /**
     * @return BookLoan[]|array
     */
    public function getPastLoans()
    {
        return $this->pastLoans;
    }

    /**
     * @param BookLoan[]|array $pastLoans
     * @return BookExemplar
     */
    public function setPastLoans($pastLoans)
    {
        $this->pastLoans = $pastLoans;
        return $this;
    }

    /**
     * @return BookLoan|null
     */
    public function getCurrentLoan(): ?BookLoan
    {
        return $this->currentLoan;
    }

    /**
     * @param BookLoan|null $currentLoan
     * @return BookExemplar
     */
    public function setCurrentLoan(?BookLoan $currentLoan): BookExemplar
    {
        $this->currentLoan = $currentLoan;
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
}