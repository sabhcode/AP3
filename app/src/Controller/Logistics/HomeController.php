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
class HomeController extends AbstractController
{
    #[Route(name: 'home')]
    public function home(): Response
    {
        if($this->getUser() && in_array("ROLE_LOGISTICS", $this->getUser()->getRoles())) {
            return $this->redirectToRoute("app_logistics_dashboard");
        }
        return $this->redirectToRoute("app_login");
    }
}
