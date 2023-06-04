<?php

namespace App\Controller;

use App\Entity\AClient;
use App\Form\AClient1Type;
use App\Repository\AClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/a/client/entity')]
class AClientEntityController extends AbstractController
{
    #[Route('/', name: 'app_a_client_entity_index', methods: ['GET'])]
    public function index(AClientRepository $aClientRepository): Response
    {
        return $this->render('a_client_entity/index.html.twig', [
            'a_clients' => $aClientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_a_client_entity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AClientRepository $aClientRepository): Response
    {
        $aClient = new AClient();
        $form = $this->createForm(AClient1Type::class, $aClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aClientRepository->save($aClient, true);

            return $this->redirectToRoute('app_a_client_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('a_client_entity/new.html.twig', [
            'a_client' => $aClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_a_client_entity_show', methods: ['GET'])]
    public function show(AClient $aClient): Response
    {
        return $this->render('a_client_entity/show.html.twig', [
            'a_client' => $aClient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_a_client_entity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AClient $aClient, AClientRepository $aClientRepository): Response
    {
        $form = $this->createForm(AClient1Type::class, $aClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aClientRepository->save($aClient, true);

            return $this->redirectToRoute('app_a_client_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('a_client_entity/edit.html.twig', [
            'a_client' => $aClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_a_client_entity_delete', methods: ['POST'])]
    public function delete(Request $request, AClient $aClient, AClientRepository $aClientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aClient->getId(), $request->request->get('_token'))) {
            $aClientRepository->remove($aClient, true);
        }

        return $this->redirectToRoute('app_a_client_entity_index', [], Response::HTTP_SEE_OTHER);
    }
}
