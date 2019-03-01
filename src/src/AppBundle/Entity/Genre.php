<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Timestampable\Traits\TimestampableEntity;

class Genre
{
    use TimestampableEntity;

    /** @var string $id */
    private $id = '';
    /** @var string $title */
    private $title = '';
    /** @var string $description */
    private $description = '';
    /** @var Book[]|array $belongsToBooks */
    private $belongsToBooks;

    /**
     * Genre constructor.
     */
    public function __construct()
    {
        $this->belongsToBooks = new ArrayCollection();
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
     * @return Genre
     */
    public function setTitle(string $title): Genre
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
     * @return Genre
     */
    public function setDescription(string $description): Genre
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Book[]|array
     */
    public function getBelongsToBooks()
    {
        return $this->belongsToBooks;
    }

    /**
     * @param Book[]|array $belongsToBooks
     * @return Genre
     */
    public function setBelongsToBooks($belongsToBooks)
    {
        $this->belongsToBooks = $belongsToBooks;
        return $this;
    }
}