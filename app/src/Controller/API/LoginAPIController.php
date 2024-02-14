<?php

namespace App\Controller\API;

use App\Entity\Credential;
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
        $response = [
            'success' => false,
            'user'
        ];

        if(!$email || !$password) {
            return new JsonResponse($response);
        }

        $credential = $credentialRepository->find($email);

        if(!$credential) {
            // J'ai fait ceci pour que le temps de chargement soit identique même si le mail n'existe pas, pour éviter un chargement trop court lors d'un envoi d'un mail
            $credential = (new Credential())->setPassword('$2a$15$9VgRe5bNdAuGd7ClbjWWjOX0.mmR1c9Asx6utQzOpJEwQJ2D/D0lC');
        }

        $verifyPassword = password_verify($password, $credential->getPassword());

        if(!$verifyPassword) {
            return new JsonResponse($response);
        }

        $response['user'] = $userRepository->findOneBy(['credential' => $credential]);
        $response['success'] = true;

        return new JsonResponse($serializer->serialize($response, 'json'), json: true);
    }
}
