<?php

namespace App\Controller;

use App\Entity\AAnnonce;
use App\Entity\AImage;
use App\Form\AAnnonceType;
use App\model\SearchForm;
use App\Repository\AAnnonceRepository;
use App\Repository\ACategoryRepository;
use App\Repository\AImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Services\UploadServices;
use App\Form\SearchFormType;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(
        Request $request, 
        AAnnonceRepository $aAnnonceRepository,
        ACategoryRepository $aCategoryRepository,
        AImageRepository $aImageRepository): Response
    {
        $searchdata = new SearchForm();
        $formSearch = $this->createForm(SearchFormType::class,$searchdata);
        $formSearch->handleRequest($request);
        if($formSearch->isSubmitted() && $formSearch->isValid())
        {
            //$searchTerm = $request->query->get("".$search_data[Search]);
            // return $this->render('employes/index.html.twig',[
            //     'formSearch'=>$formSearch->createView(),
            //     'employes'=>$Empls
            // ]);

            return $this->render('home/resultat/index.html.twig', [
                'a_annonces' => $aAnnonceRepository->findByParam($searchdata->getVille(),$searchdata->getType(),$searchdata->getChambres(),$searchdata->getPrixMax(),$searchdata->getSurfaceMin()),
                'categorys' => $aCategoryRepository->findAll(),
                'AImages' => $aImageRepository->findAll(),
            ]);
        }
        
        return $this->render('home/index.html.twig', [
            'formSearch'=>$formSearch->createView(),
        ]);
    }

    #[Route('/home/resultat', name: 'app_resultat_home')]
    public function resultat( AAnnonceRepository $aAnnonceRepository , 
    ACategoryRepository $aCategoryRepository,
    AImageRepository $aImageRepository): Response
    {
       
    {
        return $this->render('home/resultat/index.html.twig', [
            'a_annonces' => $aAnnonceRepository->findAll(),
            'categorys' => $aCategoryRepository->findAll(),
            'AImages' => $aImageRepository->findAll(),
        ]);
    }
    }

    #[Route('/home/resultat/{id}', name: 'app_resultat_annonce_show', methods: ['GET'])]
    public function show(AAnnonce $aAnnonce): Response
    {
        return $this->render('home/resultat/show.html.twig', [
            'a_annonce' => $aAnnonce,
        ]);
    }

}
