<?php

namespace AppBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\UserInterface;

class Employee implements UserInterface
{
    use TimestampableEntity;

    /** @var string $id */
    private $id = '';
    /** @var string $firstName */
    private $firstName = '';
    /** @var string $insertion */
    private $insertion = '';
    /** @var string $lastName */
    private $lastName = '';
    /** @var string $email */
    private $email = '';
    /** @var string $phoneNumber */
    private $phoneNumber = '';
    /** @var Location|null $location */
    private $location;


    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }


    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }


    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Employee
     */
    public function setFirstName(string $firstName): Employee
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getInsertion(): string
    {
        return $this->insertion;
    }

    /**
     * @param string $insertion
     * @return Employee
     */
    public function setInsertion(string $insertion): Employee
    {
        $this->insertion = $insertion;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Employee
     */
    public function setLastName(string $lastName): Employee
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Employee
     */
    public function setEmail(string $email): Employee
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return Employee
     */
    public function setPhoneNumber(string $phoneNumber): Employee
    {
        $this->phoneNumber = $phoneNumber;
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
     * @return Employee
     */
    public function setLocation(?Location $location): Employee
    {
        $this->location = $location;
        return $this;
    }
}