<?php

namespace App\Controller;

use App\Entity\AAnnonce;
use App\Entity\AImage;
use App\Form\AAnnonceType;
use App\Form\ImageType;
use App\Repository\AAnnonceRepository;
use App\Repository\ACategoryRepository;
use App\Repository\AImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Services\UploadServices;

#[Route('/proprietaire/annonce')]
class AAnnonceController extends AbstractController
{
    #[Route('/{page<\d+>?1}/{nbre<\d+>?6}', name: 'app_annonce_index', methods: ['GET'])]
    public function index(
        AAnnonceRepository $aAnnonceRepository , 
        ACategoryRepository $aCategoryRepository,
        AImageRepository $aImageRepository,
        int $page,
        int $nbre): Response
    {
        $nbAnnonce = $aAnnonceRepository->count([]);
        $nbrePage = ceil($nbAnnonce/$nbre);
        return $this->render('a_annonce/index.html.twig', [
            // 'a_annonces' => $aAnnonceRepository->findAll(),
            'a_annonces'    => $aAnnonceRepository->findBy([],[],$nbre,($page-1)*$nbre),
            'categorys'     => $aCategoryRepository->findAll(),
            'AImages'       => $aImageRepository->findAll(),
            'page'          => $page,
            'nbrePage'      => $nbrePage,
            'nbre'          => $nbre,
        ]);
    }

    #[Route('/new', name: 'app_annonce_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        PersistenceManagerRegistry $doctrine,
        UploadServices $uploadServices): Response
    {
        $aAnnonce = new AAnnonce();
        $form = $this->createForm(AAnnonceType::class, $aAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() /* && $form->isValid() */ ) {
            //dd($form->get('aImages')->get('__name__')->get('image')->getData());
            $images = $form->get('aImages')->get('__name__')->get('image')->getData() ;
            if ($images) {
                $directory= $this->getParameter('Annonce_image_directory');
                $aAnnonce->getAImages()->clear();
                $manager=$doctrine->getManager();
                foreach($images as $image)
                {
                    $AImage = new AImage();
                    $AImage->setImage($uploadServices->uploadFile($image,$directory));
                    $AImage->setIannonce($aAnnonce->getId());
                    $aAnnonce->addAImage($AImage);
                    $manager->persist($AImage);
                }
            } 
            $manager->persist($aAnnonce);
            $manager->flush();
            $this->addFlash('succes',"l'annonce a été ajouté avec succés");

            //$aAnnonceRepository->save($aAnnonce, true);
            return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('a_annonce/new.html.twig', [
            'a_annonce' => $aAnnonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_annonce_show', methods: ['GET'])]
    public function show(AAnnonce $aAnnonce): Response
    {
        return $this->render('a_annonce/show.html.twig', [
            'a_annonce' => $aAnnonce,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_annonce_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        AAnnonce $aAnnonce,
        PersistenceManagerRegistry $doctrine,
        UploadServices $uploadServices): Response
    {
        $oldImages = $aAnnonce->getAImages()->toArray();
        //dd($aAnnonce->getAImages()->toArray());
        $form = $this->createForm(AAnnonceType::class, $aAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager=$doctrine->getManager();
            foreach($oldImages as $oldImage)
            {
                $imagepath="C:/xampp/htdocs/Symfony/PFA-Symfony/assets/uploads/Annonce_Image/".$oldImage->getImage();
                if (file_exists($imagepath)) {
                    unlink($imagepath);
                }
                $manager->remove($oldImage);
            }
            $manager->flush();
            $newImages = $form->get('aImages')->get('__name__')->get('image')->getData() ;
            if ($newImages) {
                $directory= $this->getParameter('Annonce_image_directory');
                $manager=$doctrine->getManager();
                foreach($newImages as $newImage)
                {
                    $AImage = new AImage();
                    $AImage->setImage($uploadServices->uploadFile($newImage,$directory));
                    $AImage->setIannonce($aAnnonce->getId());
                    $aAnnonce->addAImage($AImage);
                    $manager->persist($AImage);
                }
            } 
            $manager->persist($aAnnonce);

            $manager->flush();
            $this->addFlash('succes',"l'annonce a été bien modifié");  

            return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);  
        }

        return $this->render('a_annonce/edit.html.twig', [
            'a_annonce' => $aAnnonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annonce_delete', methods: ['GET', 'POST'])]
    public function delete(
        Request $request, 
        AAnnonce $aAnnonce, 
        AAnnonceRepository $aAnnonceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aAnnonce->getId(), $request->request->get('_token'))) {
            $oldImages = $aAnnonce->getAImages()->toArray();
            foreach($oldImages as $oldImage)
                {
                    $imagepath="C:/xampp/htdocs/Symfony/PFA-Symfony/assets/uploads/Annonce_Image/".$oldImage->getImage();
                    if (file_exists($imagepath)) {
                        unlink($imagepath);
                    }
                }
            $aAnnonceRepository->remove($aAnnonce, true);
            $this->addFlash('delete',"l'annonce a été  supprimé ");
        }

        return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
    }
}
