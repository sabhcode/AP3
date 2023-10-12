<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/produit/{produit}', name: 'app_produit')]
    public function index(Product $produit): Response
    {

        return $this->render('produit/produit.html.twig', ['produit' => $produit]);
    }
}