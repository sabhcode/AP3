<?php

namespace App\Controller\Logistics;

use App\Repository\StockShelfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashboard',
    name: 'app_logistics_',
    requirements: ['host' => '%app.host.logistics%'],
    defaults: ['host' => '%app.host.logistics%'],
    host: '{host}')
]
#[IsGranted('ROLE_LOGISTICS')]
class DashboardController extends AbstractController
{
    #[Route(name: 'dashboard')]
    public function index(StockShelfRepository $stockShelfRepository): Response
    {
        $products = $stockShelfRepository->findAll();

        return $this->render('logistics/dashboard/dashboard.html.twig', [
            'products' => $products
        ]);
    }
}
