<?php

namespace App\Controller\Client;

use App\Entity\OrderUser;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/mon-profil', name: 'app_client_', host: '{host}', defaults: ['host' => '%app.host.client%'], requirements: ['host' => '%app.host.client%'])]
#[IsGranted("ROLE_USER")]
class ProfilController extends AbstractController
{
    #[Route(name: 'profil')]
    public function profil(): Response
    {
        return $this->render('client/profil/profil.html.twig');
    }
    
    #[Route("/order/{id}", name: 'my_order')]
    public function getOrder(OrderUser $order, #[CurrentUser] $user): Response
    {
        if($order->getUser()->getId() === $user->getId()) {

            return $this->render('client/profil/order.html.twig', [
                'order' => $order
            ]);

        }
        return $this->redirectToRoute("app_client_profil");
    }
}
    