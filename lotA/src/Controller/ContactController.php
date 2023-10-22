<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {

        $email = 'bastien.mohamed.corentin.soufiane@gmail.com';

        return $this->render('contact/contact.html.twig', [

            'email' => $email,

        ]);
    }
}