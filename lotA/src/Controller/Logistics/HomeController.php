<?php

namespace App\Controller\Logistics;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(host: '{host}', defaults: ['host' => '%app.host.logistics%'], requirements: ['host' => '%app.host.logistics%'], name: 'app_logistics_')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return new Response("Gestion de stock");
    }
}
