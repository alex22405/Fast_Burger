<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    // Gestion de la connexion de l'administrateur
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

         // Récupération de l'erreur d'authentification
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupération du dernier nom d'utilisateur saisi
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    // Gestion de la déconnexion de l'administrateur
    public function logout(): void
    {
        throw new \LogicException('Cette méthode peut rester vide - elle sera interceptée par la clé de déconnexion de votre pare-feu.');
    }
}
