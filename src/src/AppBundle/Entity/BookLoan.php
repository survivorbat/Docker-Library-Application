<?php

namespace AppBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;

class BookLoan
{
    use TimestampableEntity;

    /** @var string $id */
    private $id = '';
    /** @var Member|null $member */
    private $member;
    /** @var BookExemplar|null $bookExemplar */
    private $bookExemplar;
    /** @var \DateTime $startDate */
    private $startDate;
    /** @var \DateTime $dueDate */
    private $dueDate;
    /** @var float $pastDueFine */
    private $pastDueFine = 0.0;

    /**
     * BookLoan constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->startDate = new \DateTime();
        $this->dueDate = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Member|null
     */
    public function getMember(): ?Member
    {
        return $this->member;
    }

    /**
     * @param Member|null $member
     * @return BookLoan
     */
    public function setMember(?Member $member): BookLoan
    {
        $this->member = $member;
        return $this;
    }

    /**
     * @return BookExemplar|null
     */
    public function getBookExemplar(): ?BookExemplar
    {
        return $this->bookExemplar;
    }

    /**
     * @param BookExemplar|null $bookExemplar
     * @return BookLoan
     */
    public function setBookExemplar(?BookExemplar $bookExemplar): BookLoan
    {
        $this->bookExemplar = $bookExemplar;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     * @return BookLoan
     */
    public function setStartDate(\DateTime $startDate): BookLoan
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate(): \DateTime
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $dueDate
     * @return BookLoan
     */
    public function setDueDate(\DateTime $dueDate): BookLoan
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getPastDueFine(): float
    {
        return $this->pastDueFine;
    }

    /**
     * @param float $pastDueFine
     * @return BookLoan
     */
    public function setPastDueFine(float $pastDueFine): BookLoan
    {
        $this->pastDueFine = $pastDueFine;
        return $this;
    }
}
