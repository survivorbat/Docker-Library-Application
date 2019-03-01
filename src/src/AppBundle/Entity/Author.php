<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Timestampable\Traits\TimestampableEntity;

class Author
{
    use TimestampableEntity;

    /** @var string $id */
    private $id = '';
    /** @var string $name */
    private $name = '';
    /** @var Book[]|array $books */
    private $books;

    /**
     * Author constructor.
     */
    public function __construct()
    {
        $this->books = new ArrayCollection();
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
     * @return Author
     */
    public function setName(string $name): Author
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Book[]|array
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * @param Book[]|array $books
     * @return Author
     */
    public function setBooks($books)
    {
        $this->books = $books;
        return $this;
    }
}