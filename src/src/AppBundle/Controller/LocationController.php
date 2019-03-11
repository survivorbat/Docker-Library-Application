<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Location;
use AppBundle\Form\LocationType;
use AppBundle\Service\LocationService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{
    /** @var LocationService $locationService */
    private $locationService;

    /**
     * LocationController constructor.
     * @param LocationService $locationService
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $locations = $this->locationService->findAll();

        return $this->render('@App/location/index.html.twig', [
            'locations' => $locations
        ]);
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return Response
     */
    public function viewAction(Request $request, Location $location): Response
    {
        return $this->render('@App/location/view.html.twig', [
            'location' => $location,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->locationService->save($location);

            $this->addFlash('info', 'Succesvol locatie toegevoegd');

            return $this->redirectToRoute('app_location_index');
        }

        return $this->render('@App/location/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return Response
     */
    public function updateAction(Request $request, Location $location): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->locationService->save($location);

            $this->addFlash('info', 'Succesvol locatie aangepast');

            return $this->redirectToRoute('app_location_index');
        }

        return $this->render('@App/location/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return Response
     */
    public function deleteAction(Request $request, Location $location): Response
    {
        $this->locationService->delete($location);

        $this->addFlash('info', 'Succesvol locatie verwijderd');

        return $this->redirectToRoute('app_location_index');
    }
}
