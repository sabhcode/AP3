<?php

namespace App\Controller;

use App\Repository\StockShelfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(StockShelfRepository $stockShelfRepository): Response
    {
        $stocksShelf = $stockShelfRepository->findAll();

        return $this->render('test/account.html.twig', [
            'stocksShelf' => $stocksShelf,
        ]);
    }
}
