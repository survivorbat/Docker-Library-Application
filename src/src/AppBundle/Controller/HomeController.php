<?php

namespace AppBundle\Controller;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('@App/home/index.html.twig', [
            'ip' => $_SERVER['SERVER_ADDR']
        ]);
    }
}