<?php

namespace App\Controller;

use App\Entity\AReservation;
use App\Form\AReservationType;
use App\Repository\AReservationRepository;
use App\Repository\AAnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/client')]
class ClientController extends AbstractController
{
    #[Route('/' , name: 'client_index', methods: ['GET'])]
    public function index(AReservationRepository $aReservationRepository): Response
    {
        return $this->render('client/clienthome.html.twig', [
            'a_reservations' => $aReservationRepository->findAll()]);
    }

    #[Route('reservations/', name: 'client_reservation_index', methods: ['GET'])]
    public function reservations(AReservationRepository $aReservationRepository,AAnnonceRepository $aAnnonceRepository): Response
    {
        return $this->render('client/a_reservation/index.html.twig', [
            'a_reservations' => $aReservationRepository->findAll(),
            'a_annonces'=> $aAnnonceRepository->findAll()
        ]);
    }

    #[Route('reservations/new', name: 'client_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AReservationRepository $aReservationRepository): Response
    {
        $aReservation = new AReservation();
        $form = $this->createForm(AReservationType::class, $aReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aReservationRepository->save($aReservation, true);

            return $this->redirectToRoute('client_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/a_reservation/new.html.twig', [
            'a_reservation' => $aReservation,
            'form' => $form,
        ]);
    }

    #[Route('reservations/{id}', name: 'client_reservation_show', methods: ['GET'])]
    public function show(AReservation $aReservation): Response
    {
        return $this->render('client/a_reservation/show.html.twig', [
            'a_reservation' => $aReservation,
        ]);
    }

    #[Route('reservations/{id}/edit', name: 'client_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AReservation $aReservation, AReservationRepository $aReservationRepository): Response
    {
        $form = $this->createForm(AReservationType::class, $aReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aReservationRepository->save($aReservation, true);

            return $this->redirectToRoute('client_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/a_reservation/edit.html.twig', [
            'a_reservation' => $aReservation,
            'form' => $form,
        ]);
    }

    #[Route('reservations/{id}', name: 'client_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, AReservation $aReservation, AReservationRepository $aReservationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aReservation->getId(), $request->request->get('_token'))) {
            $aReservationRepository->remove($aReservation, true);
        }

        return $this->redirectToRoute('client_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
