<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Form\BookType;
use AppBundle\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        $books = $this->bookService->findAll();

        return $this->render('@App/book/index.html.twig', [
            'books' => $books
        ]);
    }

    /**
     * @param Request $request
     * @param Book $book
     * @return Response
     */
    public function viewAction(Request $request, Book $book): Response
    {
        return $this->render('@App/book/view.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bookService->save($book);

            $this->addFlash('info', 'Succesvol boek toegevoegd');

            return $this->redirectToRoute('app_book_index');
        }

        return $this->render('@App/book/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Book $book
     * @return Response
     */
    public function updateAction(Request $request, Book $book): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bookService->save($book);

            $this->addFlash('info', 'Succesvol boek aangepast');

            return $this->redirectToRoute('app_book_index');
        }

        return $this->render('@App/book/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Book $book
     * @return Response
     */
    public function deleteAction(Request $request, Book $book): Response
    {
        $this->bookService->delete($book);

        $this->addFlash('info', 'Succesvol boek verwijderd');

        return $this->redirectToRoute('app_book_index');
    }
}
