<?php

namespace AppBundle\Service;

use AppBundle\Entity\Employee;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class EmployeeService
{
    /** @var ObjectRepository $employeeRepository */
    private $employeeRepository;
    /** @var EntityManagerInterface $em */
    private $em;

    /**
     * EmployeeService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->employeeRepository = $entityManager->getRepository(Employee::class);
    }

    /**
     * @return Employee[]|array
     */
    public function findAll(): array
    {
        /** @var Employee[]|array $employees */
        $employees = $this->employeeRepository->findBy([], ['createdAt' => 'DESC']);

        return $employees;
    }

    /**
     * @param Employee $employee
     */
    public function save(Employee $employee): void
    {
        $this->em->persist($employee);
        $this->em->flush();
    }

    /**
     * @param Employee $employee
     */
    public function delete(Employee $employee): void
    {
        $this->em->remove($employee);
        $this->em->flush();
    }
}
