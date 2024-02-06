<?php

namespace App\Controller\API;

use App\Repository\CredentialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginAPIController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: 'POST')]
    public function login(Request $request, CredentialRepository $credentialRepository): ?Response
    {

        $email = $request->request->get('email');
        $password = $request->request->get('password');

        if(!$email || !$password) {
            return null;
        }

        $credential = $credentialRepository->find($email);

        if(!$credential) {
            return null;
        }

        $verifyPassword = password_verify($password, $credential->getPassword());

        return new JsonResponse($verifyPassword);

    }
}
