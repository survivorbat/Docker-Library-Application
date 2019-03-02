<?php

namespace AppBundle\Controller;

use AppBundle\Service\BookService;
use AppBundle\Service\GenreService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GenreController extends Controller
{
    /** @var GenreService $genreService */
    private $genreService;

    /**
     * BookController constructor.
     * @param GenreService $genreService
     */
    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('@App/genre/index.html.twig', [
            'books' => $this->genreService->findAll()
        ]);
    }
}
