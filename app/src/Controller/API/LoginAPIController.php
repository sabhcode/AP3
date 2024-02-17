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
    #[Route(
        '/api/login',
        'api_login',
        methods: 'POST'
    )]
    public function login(Request $request, CredentialRepository $credentialRepository, UserRepository $userRepository, SerializerInterface $serializer): Response
    {
        $email = htmlentities(trim($request->request->get('email')));
        $password = htmlentities(trim($request->request->get('password')));

        if(!$email || !$password) {
            return new Response(status: 400);
        }

        $response = [
            'success' => false,
            'user'
        ];

        $credential = $credentialRepository->find($email);

        if(!$credential) {
            // J'ai fait ceci pour que le temps de chargement soit identique même si le mail n'existe pas, pour éviter un chargement trop court lors d'un envoi d'un mail non trouvé
            $credential = (new Credential())->setPassword('$2a$15$cAM9iMr8Bngutu9oW5aw3OTJnB7shObk4RGGHpbA12PYZGVvPDnFe'); // mdp : (loading)
        }

        $verifyPassword = password_verify($password, $credential->getPassword());

        if(!$verifyPassword || !$credential->getEmail()) {
            return new JsonResponse($response);
        }

        $response['user'] = $userRepository->findOneBy(['credential' => $credential]);
        $response['success'] = true;

        return new JsonResponse($serializer->serialize($response, 'json'), json: true);
    }
}
