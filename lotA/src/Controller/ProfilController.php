<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Form\ChangePasswordType;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function profile(): Response
    {
        // Récupère l'utilisateur connecté
        $user = $this->getUser();
    
        // Renvoie à la vue avec l'utilisateur comme variable
        return $this->render('profil/profil.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/changePass', name: 'app_changePassword')]
    public function changePassword(#[CurrentUser] $user, Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChangePasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if (!$user) {
                // Handle the case where the user is not logged in
                // Redirect to login page, show error message, etc.
                return $this->redirectToRoute('login');
            }

            // get the Credential entity and set the new password
            $credential = $user->getCredential();
            $credential->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('newPassword')->getData()
                )
            );

            $entityManager->persist($credential);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
    