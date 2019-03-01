<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Timestampable\Traits\TimestampableEntity;

class Member
{
    use TimestampableEntity;

    /** @var string $id */
    private $id = '';
    /** @var string $name */
    private $name = '';
    /** @var Location|null $primaryLocation */
    private $primaryLocation;
    /** @var BookLoan[]|array $bookLoans */
    private $bookLoans;

    /**
     * Member constructor.
     */
    public function __construct()
    {
        $this->bookLoans = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Member
     */
    public function setName(string $name): Member
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Location|null
     */
    public function getPrimaryLocation(): ?Location
    {
        return $this->primaryLocation;
    }

    /**
     * @param Location|null $primaryLocation
     * @return Member
     */
    public function setPrimaryLocation(?Location $primaryLocation): Member
    {
        $this->primaryLocation = $primaryLocation;
        return $this;
    }

    /**
     * @return BookLoan[]|array
     */
    public function getBookLoans()
    {
        return $this->bookLoans;
    }

    /**
     * @param BookLoan[]|array $bookLoans
     * @return Member
     */
    public function setBookLoans($bookLoans)
    {
        $this->bookLoans = $bookLoans;
        return $this;
    }
}