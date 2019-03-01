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
     */
    public function setMember(?Member $member): void
    {
        $this->member = $member;
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
     */
    public function setBookExemplar(?BookExemplar $bookExemplar): void
    {
        $this->bookExemplar = $bookExemplar;
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
     */
    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
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
     */
    public function setDueDate(\DateTime $dueDate): void
    {
        $this->dueDate = $dueDate;
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
     */
    public function setPastDueFine(float $pastDueFine): void
    {
        $this->pastDueFine = $pastDueFine;
    }
}