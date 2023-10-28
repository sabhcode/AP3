<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/mon-profil', name: 'app_client_', host: '{host}', defaults: ['host' => '%app.host.client%'], requirements: ['host' => '%app.host.client%'])]
#[IsGranted("ROLE_USER")]
class ProfilController extends AbstractController
{
    #[Route(name: 'profil')]
    public function profil(): Response
    {
        return $this->render('client/profil/profil.html.twig');
    }
}
    