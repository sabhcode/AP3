<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginAPIController extends AbstractController
{
    #[Route('/login/api', name: 'app_login_api')]
    public function index(): Response
    {
        return $this->render('login_api/index.html.twig', [
            'controller_name' => 'LoginAPIController',
        ]);
    }
}
