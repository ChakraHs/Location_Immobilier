<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPropriType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Services\UploadServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'p' => 3
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository,PersistenceManagerRegistry $doctrine,): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dd($form);
            $clientData=$form->get('aClient')->getData();
            //dd($clientData['cnom']);
            //$userRepository->save($user, true);
            $this->getUser()->getAClient()->setCnom($clientData['cnom']);
            $this->getUser()->getAClient()->setCprenom($clientData['cprenom']);
            $this->getUser()->getAClient()->setCtele($clientData['ctele']);
            $manager=$doctrine->getManager();
            $manager->persist($this->getUser()->getAClient());
            $manager->flush();
            //$userRepository->save($user, true);
            return $this->redirectToRoute('app_user_show',['id'=>$this->getUser()->getId(),], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'p' => 3,
        ]);
    }

    #[Route('/{id}/editpro', name: 'app_user_editpro', methods: ['GET', 'POST'])]
    public function editproprietaire(Request $request, User $user, UserRepository $userRepository,PersistenceManagerRegistry $doctrine,UploadServices $uploadServices): Response
    {
        $form = $this->createForm(UserPropriType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() /* && $form->isValid() */) {

            $proprietaireData=$form->get('aProprietaire');
            //dd($clientData['cnom']);
            //$userRepository->save($user, true);
            $this->getUser()->getAProprietaire()->setPnom($proprietaireData->get('pnom')->getData());
            $this->getUser()->getAProprietaire()->setPprenom($proprietaireData->get('pprenom')->getData());
            $this->getUser()->getAProprietaire()->setPtele($proprietaireData->get('ptele')->getData());
            $this->getUser()->getAProprietaire()->setPcin($proprietaireData->get('pcin')->getData());
            $this->getUser()->getAProprietaire()->setPuser($user);
            $pdf=$proprietaireData->get('pcinimage')->getData();
            if($pdf)
            {
                $directory= $this->getParameter('Propritaire_Pdf_directory');
                $this->getUser()->getAProprietaire()->setPcinimage($uploadServices->uploadFile($pdf,$directory));
            }
            $manager=$doctrine->getManager();
            $manager->persist($this->getUser()->getAProprietaire());
            $manager->flush();
            //$userRepository->save($user, true);
            return $this->redirectToRoute('app_user_show',['id'=>$this->getUser()->getId(),], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'p' => 3,
        ]);
    }
    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
