<?php

namespace App\Controller;

use App\Entity\AAnnonce;
use App\model\SearchForm;
use App\Repository\AAnnonceRepository;
use App\Repository\ACategoryRepository;
use App\Repository\AReservationRepository;
use App\Repository\AImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchFormType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Form\RegistrationFormType;


class HomeController extends AbstractController
{
    #[Route('/home/{page<\d+>?1}/{nbre<\d+>?6}', name: 'app_home')]
    public function index(
        Request $request, 
        AAnnonceRepository $aAnnonceRepository,
        ACategoryRepository $aCategoryRepository,
        AImageRepository $aImageRepository,
        AReservationRepository $aReservationRepository,
        int $page,
        int $nbre,
        AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser())
        if($this->getUser()->getRoles()[0]=='ROLE_PROPRIETAIRE')
        {
            return $this->redirectToRoute('app_annonce_accueil');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $searchdata = new SearchForm();
        $formSearch = $this->createForm(SearchFormType::class,$searchdata);
        $formSearch->handleRequest($request);
        if($formSearch->isSubmitted() )
        {
            //$searchTerm = $request->query->get("".$search_data[Search]);
            // return $this->render('employes/index.html.twig',[
            //     'formSearch'=>$formSearch->createView(),
            //     'employes'=>$Empls
            // ]);
            // $idType=[];
            // if($searchdata->getType())
            // {
            //     $aCategorys =$aCategoryRepository->findAll();
            //     foreach($aCategorys as $aCategory)
            //     {
            //         if($aCategory->getCatnom() === $searchdata->getType())
            //         {
            //             $idType = $aCategory->getId();
            //         }
            //     }
            //     // dd($searchdata->getType(),$idType);
            // }
            // $criteria = [
            //     //'aville'=>$searchdata->getVille(),
            //     //'acategory'=> $idType ,
            //      'bedrooms'=>[`>`,$searchdata->getChambres()],
            //     // 'aprix'=>['<=',$searchdata->getPrixMax()],
            //     // 'Surface'=>['>=',$searchdata->getSurfaceMin()],
            // ];
            $nbAnnonce = $aAnnonceRepository->count([]);
            $nbrePage = ceil($nbAnnonce/$nbre);
            return $this->render('a_annonce/index.html.twig', [
                'a_annonces' => $aAnnonceRepository->findByParam(
                    $searchdata->getVille(),
                    $searchdata->getType(),
                    $searchdata->getChambres(),
                    $searchdata->getPrixMax(),
                    $searchdata->getSurfaceMin(),
                    ($page-1)*$nbre,
                    $nbre),
                'categorys' => $aCategoryRepository->findAll(),
                'AImages' => $aImageRepository->findAll(),
                'page'          => $page,
                'nbrePage'      => $nbrePage,
                'nbre'          => $nbre,
                'last_username' => $lastUsername,
                'error'         => $error,
                'registrationForm' => $form->createView(),
                'searchdata'=>$searchdata,
            ]);
        }
        $nbAnnonce = $aAnnonceRepository->count([]);
        $nbrePage = ceil($nbAnnonce/$nbre);
        $reservationClient=null;
        if($this->getUser())
        $reservationClient = $this->getUser()->getAClient()->getCreservations();
        return $this->render('home/index.html.twig', [
            'formSearch'=>$formSearch->createView(),
            'a_annonces'    => $aAnnonceRepository->findBy([],[],$nbre,($page-1)*$nbre),
            'categorys'     => $aCategoryRepository->findAll(),
            'AImages'       => $aImageRepository->findAll(),
            'page'          => $page,
            'nbrePage'      => $nbrePage,
            'nbre'          => $nbre,
            'last_username' => $lastUsername,
            'error'         => $error,
            'a_reservations' => $reservationClient,
            'p' => 1,


            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/home/resultat/{page<\d+>?1}/{nbre<\d+>?6}', name: 'app_resultat_home')]
    public function resultat(
        Request $request, 
        AAnnonceRepository $aAnnonceRepository,
        ACategoryRepository $aCategoryRepository,
        AImageRepository $aImageRepository,
        int $page,
        int $nbre,
        AuthenticationUtils $authenticationUtils): Response
    {
        $villedata = $request->query->get('ville');
        $typedata = $request->query->get('type');
        $chambresdata = $request->query->get('chambres');
        $surfaceMindata = $request->query->get('surfaceMin');
        $prixMaxdata = $request->query->get('prixMax');
        $searchdata = [
            'ville'   => $villedata,
            'type'   => $typedata,
            'chambres'   => $chambresdata,
            'prixMax'   => $prixMaxdata,
            'surfaceMin'   => $surfaceMindata,
        ];
        //dd($villedata,$typedata,$chambresdata,$surfaceMindata,$prixMaxdata);
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $nbAnnonce = $aAnnonceRepository->count([]);
        $nbrePage = ceil($nbAnnonce/$nbre);

    return $this->render('a_annonce/index.html.twig', [
            'a_annonces' => $aAnnonceRepository->findByParam(
                $villedata,
                $typedata,
                $chambresdata,
                $prixMaxdata,
                $surfaceMindata,
                ($page-1)*$nbre,
                $nbre),
            'categorys' => $aCategoryRepository->findAll(),
            'AImages' => $aImageRepository->findAll(),
            'page'          => $page,
            'nbrePage'      => $nbrePage,
            'nbre'          => $nbre,
            'last_username' => $lastUsername,
            'error'         => $error,
            'registrationForm' => $form->createView(),
            'searchdata'=>$searchdata,
    ]);
    }

    #[Route('/home/resultat/{id}', name: 'app_resultat_annonce_show', methods: ['GET'])]
    public function show(AAnnonce $aAnnonce): Response
    {
        return $this->render('home/resultat/show.html.twig', [
            'a_annonce' => $aAnnonce,
        ]);
    }

}
