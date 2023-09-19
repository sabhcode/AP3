<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilUserController extends AbstractController
{
    #[Route('/profilUser', name: 'app_profilUser')]
    public function index(UserRepository $userRepository): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();
    
        // Passer les informations de l'utilisateur au template
        return $this->render('profil_user/profil.html.twig', [
            'user' => $user,
        ]);
    }
    
}