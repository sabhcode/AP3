<?php

namespace App\Controller\API;

use App\Repository\CredentialRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LoginAPIController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: 'POST')]
    public function login(Request $request, CredentialRepository $credentialRepository, UserRepository $userRepository, SerializerInterface $serializer): Response
    {

        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $response = false;

        if(!$email || !$password) {
            return new JsonResponse($response);
        }

        $credential = $credentialRepository->find($email);

        if(!$credential) {
            return new JsonResponse($response);
        }

        $verifyPassword = password_verify($password, $credential->getPassword());

        if(!$verifyPassword) {
            return new JsonResponse($response);
        }

        $response = $userRepository->findOneBy(['credential' => $credential]);

        return new JsonResponse($serializer->serialize($response, 'json'), json: true);

    }
}
