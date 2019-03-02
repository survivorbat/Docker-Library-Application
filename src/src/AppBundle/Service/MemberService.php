<?php

namespace AppBundle\Service;

use AppBundle\Entity\Member;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class MemberService
{
    /** @var ObjectRepository $memberRepository */
    private $memberRepository;
    /** @var EntityManagerInterface $em */
    private $em;

    /**
     * MemberService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->memberRepository = $entityManager->getRepository(Member::class);
    }

    /**
     * @return Member[]|array
     */
    public function findAll(): array
    {
        /** @var Member[]|array $members */
        $members = $this->memberRepository->findBy([], ['createdAt' => 'DESC']);

        return $members;
    }

    /**
     * @param Member $member
     */
    public function save(Member $member): void
    {
        $this->em->persist($member);
        $this->em->flush();
    }

    /**
     * @param Member $member
     */
    public function delete(Member $member): void
    {
        $this->em->remove($member);
        $this->em->flush();
    }
}
