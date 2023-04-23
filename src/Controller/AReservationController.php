<?php

namespace App\Controller;

use App\Entity\AReservation;
use App\Form\AReservationType;
use App\Repository\AReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation')]
class AReservationController extends AbstractController
{
    #[Route('/', name: 'app_reservation_index', methods: ['GET'])]
    public function index(AReservationRepository $aReservationRepository): Response
    {
        return $this->render('a_reservation/index.html.twig', [
            'a_reservations' => $aReservationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AReservationRepository $aReservationRepository): Response
    {
        $aReservation = new AReservation();
        $form = $this->createForm(AReservationType::class, $aReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aReservationRepository->save($aReservation, true);

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('a_reservation/new.html.twig', [
            'a_reservation' => $aReservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(AReservation $aReservation): Response
    {
        return $this->render('a_reservation/show.html.twig', [
            'a_reservation' => $aReservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AReservation $aReservation, AReservationRepository $aReservationRepository): Response
    {
        $form = $this->createForm(AReservationType::class, $aReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aReservationRepository->save($aReservation, true);

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('a_reservation/edit.html.twig', [
            'a_reservation' => $aReservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, AReservation $aReservation, AReservationRepository $aReservationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aReservation->getId(), $request->request->get('_token'))) {
            $aReservationRepository->remove($aReservation, true);
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
