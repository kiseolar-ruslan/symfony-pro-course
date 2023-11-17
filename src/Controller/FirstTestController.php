<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstTestController extends AbstractController
{
    #[Route('/test', name: 'app_first_test')]
    public function index(): Response
    {
        return $this->render('first_test/index.html.twig', [
            'controller_name' => 'FirstTestController',
        ]);
    }
}
