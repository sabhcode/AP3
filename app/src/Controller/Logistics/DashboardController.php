<?php

namespace App\Controller\Logistics;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(host: '{host}', name: 'app_logistics_', defaults: ['host' => '%app.host.logistics%'], requirements: ['host' => '%app.host.logistics%'])]
#[IsGranted('ROLE_LOGISTICS')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('logistics/dashboard/dashboard.html.twig');
    }
}
