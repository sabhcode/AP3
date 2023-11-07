<?php

namespace App\Controller\Client;

use App\Entity\OrderState;
use App\Entity\OrderUser;
use App\Entity\User;
use App\Repository\OrderStateRepository;
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
    
    #[Route("/commande/{id}", name: 'my_order')]
    public function getOrder(OrderUser $order, OrderStateRepository $orderStateRepository, #[CurrentUser] $user): Response
    {
        if($order->getUser()->getId() === $user->getId()) {

            $orderStates = $orderStateRepository->findAll();

            return $this->render('client/profil/order.html.twig', [
                'order' => $order,
                'orderStates' => $orderStates
            ]);

        }
        return $this->redirectToRoute("app_client_profil");
    }
}
    