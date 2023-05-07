<?php

namespace App\Controller;

use App\Entity\AAnnonce;
use App\Entity\AImage;
use App\Form\AAnnonceType;
use App\Repository\AAnnonceRepository;
use App\Repository\ACategoryRepository;
use App\Repository\AImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Services\UploadServices;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/resultat', name: 'app_resultat_home')]
    public function show( AAnnonceRepository $aAnnonceRepository , 
    ACategoryRepository $aCategoryRepository,
    AImageRepository $aImageRepository): Response
    {
       
    {
        return $this->render('home/a_annonce/index.html.twig', [
            'a_annonces' => $aAnnonceRepository->findAll(),
            'categorys' => $aCategoryRepository->findAll(),
            'AImages' => $aImageRepository->findAll(),
        ]);
    }
    }

}
