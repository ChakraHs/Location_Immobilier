<?php

namespace App\Controller;

use App\Entity\AAnnonce;
use App\Entity\AReservation;
use App\Form\AReservationType;
use App\Repository\AReservationRepository;
use App\Repository\AAnnonceRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReserverController extends AbstractController
{

    private $AReservationRepository;
    private $entityManager;

    public function __construct(AReservationRepository $AReservationRepository, ManagerRegistry $doctrine)
    {
        $this->AReservationRepository = $AReservationRepository;
        $this->entityManager = $doctrine->getManager();
    }


    #[Route('/home/resultat/reserver/{annonce}', name: 'app_resultat_reservation', methods: ['GET', 'POST'])]
    public function store(Request $request, AReservationRepository $aReservationRepository, AAnnonce $annonce): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_home');
        }

        $infoReservationDate=$request->query->get('infoReservationDate');
        $infoReservationNbmois=$request->query->get('infoReservationNbmois');
        
        $aReservation = new AReservation();
        $aReservation->setRannonce($annonce);
        $aReservation->setRdateentree(new \DateTime($infoReservationDate));
        $aReservation->setRnombremois($infoReservationNbmois);
        $aReservation->setRcontrat("processing...");
        $aReservation->setRclient($this->getUser()->getAClient());
        //dd($this->getUser()->getAClient()->getId());

        $this->entityManager->persist($aReservation);

        $this->entityManager->flush();
        $this->addFlash(
            'success',
            'your reservation was saved'
        );

        return $this->redirectToRoute('client_reservation_index');
    }
}
