<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BookLoan;
use AppBundle\Form\BookLoanType;
use AppBundle\Service\BookLoanService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookLoanController extends Controller
{
    /** @var BookLoanService $bookLoanService */
    private $bookLoanService;

    /**
     * BookLoanController constructor.
     * @param BookLoanService $bookLoanService
     */
    public function __construct(BookLoanService $bookLoanService)
    {
        $this->bookLoanService = $bookLoanService;
    }

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $bookLoans = $this->bookLoanService->findAll();

        return $this->render('@App/bookLoan/index.html.twig', [
            'bookLoans' => $bookLoans
        ]);
    }

    /**
     * @param Request $request
     * @param BookLoan $bookLoan
     * @return Response
     */
    public function viewAction(Request $request, BookLoan $bookLoan): Response
    {
        return $this->render('@App/bookLoan/view.html.twig', [
            'bookLoan' => $bookLoan,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function createAction(Request $request): Response
    {
        $bookLoan = new BookLoan();
        $form = $this->createForm(BookLoanType::class, $bookLoan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bookLoanService->save($bookLoan);

            $this->addFlash('info', 'Succesvol auteur toegevoegd');

            return $this->redirectToRoute('app_bookLoan_index');
        }

        return $this->render('@App/bookLoan/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param BookLoan $bookLoan
     * @return Response
     */
    public function updateAction(Request $request, BookLoan $bookLoan): Response
    {
        $form = $this->createForm(BookLoanType::class, $bookLoan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bookLoanService->save($bookLoan);

            $this->addFlash('info', 'Succesvol auteur aangepast');

            return $this->redirectToRoute('app_bookLoan_index');
        }

        return $this->render('@App/bookLoan/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param BookLoan $bookLoan
     * @return Response
     */
    public function deleteAction(Request $request, BookLoan $bookLoan): Response
    {
        $this->bookLoanService->delete($bookLoan);

        $this->addFlash('info', 'Succesvol auteur verwijderd');

        return $this->redirectToRoute('app_bookLoan_index');
    }
}
