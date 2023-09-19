<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilUserController extends AbstractController
{
    #[Route('/profilUser', name: 'app_profilUser')]
    public function index(): Response
    {
        return $this->render('profil_user/profil.html.twig', [
            'controller_name' => '¨ProfilUserController',
          
        ]);
    }
}