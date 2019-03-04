<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Form\AuthorType;
use AppBundle\Service\AuthorService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    /** @var AuthorService $authorService */
    private $authorService;

    /**
     * AuthorController constructor.
     * @param AuthorService $authorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $authors = $this->authorService->findAll();

        return $this->render('@App/author/index.html.twig', [
            'authors' => $authors
        ]);
    }

    /**
     * @param Request $request
     * @param Author $author
     * @return Response
     */
    public function viewAction(Request $request, Author $author): Response
    {
        return $this->render('@App/author/view.html.twig', [
            'author' => $author,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->authorService->save($author);

            $this->addFlash('info', 'Succesvol auteur toegevoegd');

            return $this->redirectToRoute('app_author_index');
        }

        return $this->render('@App/author/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Author $author
     * @return Response
     */
    public function updateAction(Request $request, Author $author): Response
    {
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->authorService->save($author);

            $this->addFlash('info', 'Succesvol auteur aangepast');

            return $this->redirectToRoute('app_author_index');
        }

        return $this->render('@App/author/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Author $author
     * @return Response
     */
    public function deleteAction(Request $request, Author $author): Response
    {
        $this->authorService->delete($author);

        $this->addFlash('info', 'Succesvol auteur verwijderd');

        return $this->redirectToRoute('app_author_index');
    }
}
