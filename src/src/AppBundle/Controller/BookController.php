<?php

namespace AppBundle\Controller;

use AppBundle\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /** @var BookService $bookService */
    private $bookService;

    /**
     * BookController constructor.
     * @param BookService $bookService
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('@App/book/index.html.twig', [
            'books' => $this->bookService->findAll()
        ]);
    }
}