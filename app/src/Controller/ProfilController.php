<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function profile(): Response
    {
        // Récupère l'utilisateur connecté
        $user = $this->getUser();
    
        // Renvoie à la vue avec l'utilisateur comme variable
        return $this->render('profil/profil.html.twig', [
            'user' => $user,
        ]);
    }
}