<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Book
{
    /** @var string $id */
    private $id = '';
    /** @var string $isbn */
    private $isbn;
    /** @var string $title */
    private $title = '';
    /** @var string $description*/
    private $description = '';
    /** @var Author|null $author */
    private $author;
    /** @var Genre[]|array $genres */
    private $genres;
    /** @var BookExemplar|array $bookExemplars */
    private $bookExemplars;

    /**
     * Book constructor.
     */
    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->bookExemplars = new ArrayCollection();
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Book
     */
    public function setTitle(string $title): Book
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Book
     */
    public function setDescription(string $description): Book
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Author|null
     */
    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    /**
     * @param Author|null $author
     * @return Book
     */
    public function setAuthor(?Author $author): Book
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Genre[]|array
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @param Genre[]|array $genres
     * @return Book
     */
    public function setGenres(array $genres)
    {
        $this->genres = $genres;
        return $this;
    }

    /**
     * @return BookExemplar|array
     */
    public function getBookExemplars(): array
    {
        return $this->bookExemplars;
    }

    /**
     * @param BookExemplar|array $bookExemplars
     * @return Book
     */
    public function setBookExamplars($bookExemplars)
    {
        $this->bookExemplars = $bookExemplars;
        return $this;
    }
}