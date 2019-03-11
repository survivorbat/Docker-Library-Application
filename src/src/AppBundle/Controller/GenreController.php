<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Genre;
use AppBundle\Form\GenreType;
use AppBundle\Service\GenreService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GenreController extends Controller
{
    /** @var GenreService $genreService */
    private $genreService;

    /**
     * GenreController constructor.
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
        $genres = $this->genreService->findAll();

        return $this->render('@App/genre/index.html.twig', [
            'genres' => $genres
        ]);
    }

    /**
     * @param Request $request
     * @param Genre $genre
     * @return Response
     */
    public function viewAction(Request $request, Genre $genre): Response
    {
        return $this->render('@App/genre/view.html.twig', [
            'genre' => $genre,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->genreService->save($genre);

            $this->addFlash('info', 'Succesvol auteur toegevoegd');

            return $this->redirectToRoute('app_genre_index');
        }

        return $this->render('@App/genre/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Genre $genre
     * @return Response
     */
    public function updateAction(Request $request, Genre $genre): Response
    {
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->genreService->save($genre);

            $this->addFlash('info', 'Succesvol auteur aangepast');

            return $this->redirectToRoute('app_genre_index');
        }

        return $this->render('@App/genre/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Genre $genre
     * @return Response
     */
    public function deleteAction(Request $request, Genre $genre): Response
    {
        $this->genreService->delete($genre);

        $this->addFlash('info', 'Succesvol auteur verwijderd');

        return $this->redirectToRoute('app_genre_index');
    }
}
