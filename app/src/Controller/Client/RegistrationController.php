<?php

namespace App\Controller\Client;

use App\Entity\Credential;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/inscription',
    name: 'app_client_',
    requirements: ['host' => '%app.host.client%'],
    defaults: ['host' => '%app.host.client%'],
    host: '{host}')
]
class RegistrationController extends AbstractController
{
    #[Route(name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $credential = new Credential();
        $user = new User();
        $user->setCredential($credential);

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted()) {

            if(!filter_var($form->get("email")->getData(), FILTER_VALIDATE_EMAIL)) {

                $form->get("email")->addError(new FormError("Veuillez saisir une adresse e-mail valide"));

            } else if($form->isValid()) {

                $credential->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );

                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_login');

            }

        }

        return $this->render('client/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
