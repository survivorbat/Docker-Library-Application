<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('app_dashboard_index');
    }
}
