<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact', host: '{host}', defaults: ['host' => '%app.host.client%'], requirements: ['host' => '%app.host.client%'], name: 'app_client_')]
class ContactController extends AbstractController
{
    #[Route(name: 'contact')]
    public function contact(): Response
    {
        $email = 'bastien.mohamed.corentin.soufiane@gmail.com';

        return $this->render('contact/contact.html.twig', [
            'email' => $email
        ]);
    }
}