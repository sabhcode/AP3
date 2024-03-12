<?php

namespace App\Controller\Client;

use App\Entity\OrderUser;
use App\Entity\User;
use App\Repository\OrderStateRepository;
use App\Service\PDFService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    '/profil',
    name: 'app_client_',
    requirements: ['host' => '%app.host.client%'],
    defaults: ['host' => '%app.host.client%'],
    host: '{host}')
]
#[IsGranted('ROLE_USER')]
class ProfilController extends AbstractController
{
    #[Route(name: 'profil')]
    public function profil(): Response
    {
        return $this->render('client/profil/profil.html.twig');
    }

    #[Route('/mes-commandes', name: 'my_orders')]
    public function getOrders(): Response
    {
        return $this->render('client/profil/orders.html.twig');
    }

    #[Route('/commande/{id}', name: 'my_order')]
    public function getOrder(OrderUser $order, OrderStateRepository $orderStateRepository): Response
    {
        /** @var User */
        $user = $this->getUser();

        if($order->getUser()?->getId() === $user->getId()) {

            $orderStates = $orderStateRepository->findAll();

            return $this->render('client/profil/order.html.twig', [
                'order' => $order,
                'orderStates' => $orderStates
            ]);

        }
        return $this->redirectToRoute('app_client_profil');
    }

    #[Route('/commande/{id}/pdf', name: 'my_confirm_order')]
    public function getConfirmOrder(OrderUser $order, PDFService $PDFService): Response
    {
        /** @var User */
        $user = $this->getUser();

        if($order->getUser()?->getId() === $user->getId()) {

            $title = 'Facture';
            $filename = 'facture-commande-num-' . $order->getId();

            $html = $this->renderView('client/profil/confirm_order.html.twig', [
                'host' => $this->getParameter('app.host.client'),
                'title' => $title,
                'order' => $order,
                'logo' => $PDFService::logoBase64
            ]);

            $PDFService->create($filename, $html);

        }
        return $this->redirectToRoute('app_client_profil');
    }
}
    