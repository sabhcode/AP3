<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/contact',
    name: 'app_client_',
    requirements: ['host' => '%app.host.client%'],
    defaults: ['host' => '%app.host.client%'],
    host: '{host}')
]
class ContactController extends AbstractController
{
    #[Route(name: 'contact')]
    public function contact(): Response
    {
        $email = 'bastien.mohamed.corentin.soufiane@gmail.com';

        return $this->render('client/contact/contact.html.twig', [
            'email' => $email
        ]);
    }
}