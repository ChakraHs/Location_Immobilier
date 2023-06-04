<?php

namespace App\Controller;

use App\Entity\AClient;
use App\Entity\AProprietaire;
use App\Entity\User;
use App\Form\RegistrationFormProprietaireType;
use App\Form\RegistrationFormType;
use App\Security\AppCustomAuthenticator;
use App\Security\EmailVerifier;
use App\Services\UploadServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        UserAuthenticatorInterface $userAuthenticator, 
        AppCustomAuthenticator $authenticator, 
        EntityManagerInterface $entityManager,
        UploadServices $uploadServices): Response
    {
        $user = new User();
        $formClient = $this->createForm(RegistrationFormType::class, $user);
        $formClient->handleRequest($request);
        $formProprietaire = $this->createForm( RegistrationFormProprietaireType::class, $user);
        $formProprietaire->handleRequest($request);

        if ($formClient->isSubmitted() && $formClient->isValid()) {
            $clientData=$formClient->get('aClient')->getData();

            $client = new AClient();
            $client->setCnom($clientData['cnom']);
            $client->setCprenom($clientData['cprenom']);
            $client->setCtele($clientData['ctele']);
            $client->setCuser($user);
            $user->setRoles(["ROLE_CLIENT"]);
            //encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $formClient->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->persist($client);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('imco12.service@gmail.com', 'imco'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
            // return $this->render('registration/register.html.twig', [
            //     'registrationForm' => $form->createView(),
            // ]);
        }
        if ($formProprietaire->isSubmitted() && $formProprietaire->isValid()) {
            $proprietaireData=$formProprietaire->get('aProprietaire');

            $proprietaire = new AProprietaire();
            $proprietaire->setPnom($proprietaireData->get('pnom')->getData());
            $proprietaire->setPprenom($proprietaireData->get('pprenom')->getData());
            $proprietaire->setPtele($proprietaireData->get('ptele')->getData());
            $proprietaire->setPcin($proprietaireData->get('pcin')->getData());
            $proprietaire->setPuser($user);
            $pdf=$proprietaireData->get('pcinimage')->getData();
            if($pdf)
            {
                $directory= $this->getParameter('Propritaire_Pdf_directory');
                $proprietaire->setPcinimage($uploadServices->uploadFile($pdf,$directory));
            }
            
            $user->setRoles(["ROLE_PROPRIETAIRE"]);
            //encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $formProprietaire->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->persist($proprietaire);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('imco12.service@gmail.com', 'imco'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
            // // return $this->render('registration/register.html.twig', [
            // //     'registrationForm' => $form->createView(),
            // // ]);
        }
        return $this->render('registration/register.html.twig', [
            'registrationFormClient' => $formClient->createView(),
            'registrationFormProprietaire' => $formProprietaire->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}
