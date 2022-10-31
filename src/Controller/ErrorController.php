<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    #[Route(path: '/error', name: 'app_error')]
    public function show(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error.html.twig', []);
    }

}