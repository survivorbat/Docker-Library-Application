<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Service\AuthorService;
use AppBundle\Service\BookService;
use AppBundle\Service\GenreService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /** @var BookService $bookService */
    private $bookService;
    /** @var GenreService $genreService */
    private $genreService;
    /** @var AuthorService $authorService */
    private $authorService;

    /**
     * BookController constructor.
     * @param BookService $bookService
     * @param AuthorService $authorService
     * @param GenreService $genreService
     */
    public function __construct(
        BookService $bookService,
        AuthorService $authorService,
        GenreService $genreService
    ) {
        $this->bookService = $bookService;
        $this->genreService = $genreService;
        $this->authorService = $authorService;
    }

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('@App/dashboard/index.html.twig', [
            'books' => $this->bookService->findAll(),
            'authors' => $this->authorService->findAll(),
            'genres' => $this->genreService->findAll(),
        ]);
    }
}
