<?php

namespace App\Controller\Logistics;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_LOGISTICS')]
class AccountController extends AbstractController
{
    #[Route('/profil', name: 'app_logistics_account')]
    public function index(): Response
    {
        return $this->render('logistics/account/account.html.twig');
    }
}
