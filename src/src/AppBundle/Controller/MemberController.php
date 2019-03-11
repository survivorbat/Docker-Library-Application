<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Member;
use AppBundle\Form\MemberType;
use AppBundle\Service\MemberService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberController extends Controller
{
    /** @var MemberService $memberService */
    private $memberService;

    /**
     * MemberController constructor.
     * @param MemberService $memberService
     */
    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $members = $this->memberService->findAll();

        return $this->render('@App/member/index.html.twig', [
            'members' => $members
        ]);
    }

    /**
     * @param Request $request
     * @param Member $member
     * @return Response
     */
    public function viewAction(Request $request, Member $member): Response
    {
        return $this->render('@App/member/view.html.twig', [
            'member' => $member,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $member = new Member();
        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->memberService->save($member);

            $this->addFlash('info', 'Succesvol auteur toegevoegd');

            return $this->redirectToRoute('app_member_index');
        }

        return $this->render('@App/member/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Member $member
     * @return Response
     */
    public function updateAction(Request $request, Member $member): Response
    {
        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->memberService->save($member);

            $this->addFlash('info', 'Succesvol auteur aangepast');

            return $this->redirectToRoute('app_member_index');
        }

        return $this->render('@App/member/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Member $member
     * @return Response
     */
    public function deleteAction(Request $request, Member $member): Response
    {
        $this->memberService->delete($member);

        $this->addFlash('info', 'Succesvol auteur verwijderd');

        return $this->redirectToRoute('app_member_index');
    }
}
