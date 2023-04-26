<?php

namespace App\Controller;

use App\Entity\AAnnonce;
use App\Form\AAnnonceType;
use App\Repository\AAnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/proprietaire/annonce')]
class AAnnonceController extends AbstractController
{
    #[Route('/', name: 'app_annonce_index', methods: ['GET'])]
    public function index(AAnnonceRepository $aAnnonceRepository): Response
    {
        return $this->render('a_annonce/index.html.twig', [
            'a_annonces' => $aAnnonceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_annonce_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AAnnonceRepository $aAnnonceRepository): Response
    {
        $aAnnonce = new AAnnonce();
        $form = $this->createForm(AAnnonceType::class, $aAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            $aAnnonceRepository->save($aAnnonce, true);

            return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('a_annonce/new.html.twig', [
            'a_annonce' => $aAnnonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annonce_show', methods: ['GET'])]
    public function show(AAnnonce $aAnnonce): Response
    {
        return $this->render('a_annonce/show.html.twig', [
            'a_annonce' => $aAnnonce,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_annonce_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AAnnonce $aAnnonce, AAnnonceRepository $aAnnonceRepository): Response
    {
        $form = $this->createForm(AAnnonceType::class, $aAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aAnnonceRepository->save($aAnnonce, true);

            return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('a_annonce/edit.html.twig', [
            'a_annonce' => $aAnnonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annonce_delete', methods: ['POST'])]
    public function delete(Request $request, AAnnonce $aAnnonce, AAnnonceRepository $aAnnonceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aAnnonce->getId(), $request->request->get('_token'))) {
            $aAnnonceRepository->remove($aAnnonce, true);
        }

        return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
    }
}
