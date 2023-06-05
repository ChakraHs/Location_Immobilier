<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class AppCustomAuthenticatorClientAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE ='app_login'/* 'app_home' */;/* 'app_login' */
    public const LOGIN_ROUTE2 ='app_home'/* 'app_home' */;/* 'app_login' */

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email', '');

        $request->getSession()->set(Security::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        $user = $token->getUser();
        if ($user instanceof UserInterface) {
            $roles = $user->getRoles();
    
            if (in_array('ROLE_CLIENT', $roles)) {
                return new RedirectResponse($this->urlGenerator->generate('app_home'));
            } elseif (in_array('ROLE_PROPRIETAIRE', $roles)) {
                return new RedirectResponse($this->urlGenerator->generate('app_annonce_index'));
            }
        }
    
        throw new \Exception('TODO: provide a valid redirect inside ' . __FILE__);
    }

    protected function getLoginUrl(Request $request): string
    {
        $currentRoute = $request->attributes->get('_route');
        if($currentRoute === 'app_home')
        {
            return $this->urlGenerator->generate(self::LOGIN_ROUTE2);
        }
        elseif($currentRoute === 'app_login')
        {
            return $this->urlGenerator->generate(self::LOGIN_ROUTE);
        }
    }
}
