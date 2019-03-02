<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Service\AuthorService;
use AppBundle\Service\BookExemplarService;
use AppBundle\Service\BookLoanService;
use AppBundle\Service\BookService;
use AppBundle\Service\EmployeeService;
use AppBundle\Service\GenreService;
use AppBundle\Service\LocationService;
use AppBundle\Service\MemberService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /** @var BookService $bookService */
    private $bookService;
    /** @var AuthorService $authorService */
    private $authorService;
    /** @var GenreService $genreService */
    private $genreService;
    /** @var EmployeeService $employeeService */
    private $employeeService;
    /** @var MemberService $memberService */
    private $memberService;
    /** @var LocationService $locationService */
    private $locationService;
    /** @var BookLoanService $bookLoanService */
    private $bookLoanService;
    /** @var BookExemplarService $bookExemplarService */
    private $bookExemplarService;

    /**
     * BookController constructor.
     * @param BookService $bookService
     * @param AuthorService $authorService
     * @param GenreService $genreService
     * @param EmployeeService $employeeService
     * @param MemberService $memberService
     * @param LocationService $locationService
     * @param BookLoanService $bookLoanService
     * @param BookExemplarService $bookExemplarService
     */
    public function __construct(
        BookService $bookService,
        AuthorService $authorService,
        GenreService $genreService,
        EmployeeService $employeeService,
        MemberService $memberService,
        LocationService $locationService,
        BookLoanService $bookLoanService,
        BookExemplarService $bookExemplarService
    ) {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
        $this->genreService = $genreService;
        $this->employeeService = $employeeService;
        $this->memberService = $memberService;
        $this->locationService = $locationService;
        $this->bookLoanService = $bookLoanService;
        $this->bookExemplarService = $bookExemplarService;
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
            'employees' => $this->employeeService->findAll(),
            'members' => $this->memberService->findAll(),
            'locations' => $this->locationService->findAll(),
            'bookLoans' => $this->bookLoanService->findAll(),
            'bookExemplars' => $this->bookExemplarService->findAll(),
        ]);
    }
}
