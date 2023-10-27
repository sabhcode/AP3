<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_USER")]
class ProfilController extends AbstractController
{
    #[Route('/mon-profil', name: 'app_profil')]
    public function profil(): Response
    {
        return $this->render('profil/profil.html.twig');
    }
}
    