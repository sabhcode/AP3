<?php

namespace App\Controller\Logistics;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    '/',
    name: 'app_logistics_',
    requirements: ['host' => '%app.host.logistics%'],
    defaults: ['host' => '%app.host.logistics%'],
    host: '{host}')
]
#[IsGranted('ROLE_LOGISTICS')]
class HomeController extends AbstractController
{
    #[Route(name: 'home')]
    public function home(): Response
    {
        return $this->redirectToRoute("app_logistics_dashboard");
    }
}
