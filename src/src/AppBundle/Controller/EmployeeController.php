<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use AppBundle\Form\EmployeeType;
use AppBundle\Service\EmployeeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /** @var EmployeeService $employeeService */
    private $employeeService;

    /**
     * EmployeeController constructor.
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $employees = $this->employeeService->findAll();

        return $this->render('@App/employee/index.html.twig', [
            'employees' => $employees
        ]);
    }

    /**
     * @param Request $request
     * @param Employee $employee
     * @return Response
     */
    public function viewAction(Request $request, Employee $employee): Response
    {
        return $this->render('@App/employee/view.html.twig', [
            'employee' => $employee,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->employeeService->save($employee);

            $this->addFlash('info', 'Succesvol auteur toegevoegd');

            return $this->redirectToRoute('app_employee_index');
        }

        return $this->render('@App/employee/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Employee $employee
     * @return Response
     */
    public function updateAction(Request $request, Employee $employee): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->employeeService->save($employee);

            $this->addFlash('info', 'Succesvol auteur aangepast');

            return $this->redirectToRoute('app_employee_index');
        }

        return $this->render('@App/employee/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Employee $employee
     * @return Response
     */
    public function deleteAction(Request $request, Employee $employee): Response
    {
        $this->employeeService->delete($employee);

        $this->addFlash('info', 'Succesvol auteur verwijderd');

        return $this->redirectToRoute('app_employee_index');
    }
}
