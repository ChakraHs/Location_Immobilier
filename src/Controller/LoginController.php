<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('security/login.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    // #[Route('/HomeClient', name: 'home_client')]
    // public function homeclient(): Response
    // {
    //     return $this->render('client/clienthome.html.twig', [
    //         'controller_name' => 'LoginController',
    //     ]);
    // }
}
