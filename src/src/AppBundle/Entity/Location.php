<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Timestampable\Traits\TimestampableEntity;

class Location
{
    use TimestampableEntity;

    /** @var string $id */
    private $id = '';
    /** @var string $name */
    private $name = '';
    /** @var string $address */
    private $address = '';
    /** @var string $city */
    private $city = '';
    /** @var string $postalCode */
    private $postalCode = '';
    /** @var \DateTime $openingDate */
    private $openingDate;
    /** @var BookExemplar[]|array $bookExemplars */
    private $bookExemplars;
    /** @var Employee[]|array $employees */
    private $employees;
    /** @var Member[]|array $members */
    private $members;

    /**
     * Location constructor.
     */
    public function __construct()
    {
        $this->bookExemplars = new ArrayCollection();
        $this->employees = new ArrayCollection();
        $this->members = new ArrayCollection();
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
     * @return Location
     */
    public function setName(string $name): Location
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Location
     */
    public function setAddress(string $address): Location
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Location
     */
    public function setCity(string $city): Location
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return Location
     */
    public function setPostalCode(string $postalCode): Location
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOpeningDate(): \DateTime
    {
        return $this->openingDate;
    }

    /**
     * @param \DateTime $openingDate
     * @return Location
     */
    public function setOpeningDate(\DateTime $openingDate): Location
    {
        $this->openingDate = $openingDate;
        return $this;
    }

    /**
     * @return BookExemplar[]|array
     */
    public function getBookExemplars()
    {
        return $this->bookExemplars;
    }

    /**
     * @param BookExemplar[]|array $bookExemplars
     * @return Location
     */
    public function setBookExemplars($bookExemplars)
    {
        $this->bookExemplars = $bookExemplars;
        return $this;
    }

    /**
     * @return Employee[]|array
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param Employee[]|array $employees
     * @return Location
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;
        return $this;
    }

    /**
     * @return Member[]|array
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param Member[]|array $members
     * @return Location
     */
    public function setMembers($members)
    {
        $this->members = $members;
        return $this;
    }
}