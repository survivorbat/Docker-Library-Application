<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BookExemplar;
use AppBundle\Form\BookExemplarType;
use AppBundle\Service\BookExemplarService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookExemplarController extends Controller
{
    /** @var BookExemplarService $bookExemplarService */
    private $bookExemplarService;

    /**
     * BookExemplarController constructor.
     * @param BookExemplarService $bookExemplarService
     */
    public function __construct(BookExemplarService $bookExemplarService)
    {
        $this->bookExemplarService = $bookExemplarService;
    }

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $bookExemplars = $this->bookExemplarService->findAll();

        return $this->render('@App/bookExemplar/index.html.twig', [
            'bookExemplars' => $bookExemplars
        ]);
    }

    /**
     * @param Request $request
     * @param BookExemplar $bookExemplar
     * @return Response
     */
    public function viewAction(Request $request, BookExemplar $bookExemplar): Response
    {
        return $this->render('@App/bookExemplar/view.html.twig', [
            'bookExemplar' => $bookExemplar,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function createAction(Request $request): Response
    {
        $bookExemplar = new BookExemplar();
        $form = $this->createForm(BookExemplarType::class, $bookExemplar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bookExemplarService->save($bookExemplar);

            $this->addFlash('info', 'Succesvol auteur toegevoegd');

            return $this->redirectToRoute('app_bookExemplar_index');
        }

        return $this->render('@App/bookExemplar/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param BookExemplar $bookExemplar
     * @return Response
     */
    public function updateAction(Request $request, BookExemplar $bookExemplar): Response
    {
        $form = $this->createForm(BookExemplarType::class, $bookExemplar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bookExemplarService->save($bookExemplar);

            $this->addFlash('info', 'Succesvol auteur aangepast');

            return $this->redirectToRoute('app_bookExemplar_index');
        }

        return $this->render('@App/bookExemplar/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param BookExemplar $bookExemplar
     * @return Response
     */
    public function deleteAction(Request $request, BookExemplar $bookExemplar): Response
    {
        $this->bookExemplarService->delete($bookExemplar);

        $this->addFlash('info', 'Succesvol auteur verwijderd');

        return $this->redirectToRoute('app_bookExemplar_index');
    }
}
