<?php

namespace App\Controller;

use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\Event\SwitchUserEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/review", name="review")
     */
    public function review(UserInterface $user = null)
    {
        if (!$user) {
            throw new AccessDeniedException('Your user is not authorised');
        }
        if (in_array('ROLE_MENTORIUS', $user->getRoles())) {
            return $this->render('admin/review.html.twig');
        }
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return $this->render('admin/plan.html.twig');
        }
        // Design system to not reach this line: produce HTTP 500 response
        throw new AccessDeniedException('User not authorised by known roles');
    }

    /**
     * @Route("/switch", name="switch")
     *
     * @see SwitchUserListener
     * @see GuardAuthenticatorHandler
     * @see InMemoryUserProvider
     */
    public function switchUser(Request $request, TokenStorageInterface $tokenStorage)
    {
        $token = new AnonymousToken(
            'testas',
            new User('mentorius', 'asfsfasMENTORIUSc34ac7068f6f1', ['ROLE_MENTORIUS']),
            ['ROLE_MENTORIUS']
        );
        $tokenStorage->setToken(
            $token
        );

//        $switchEvent = new SwitchUserEvent($request, $token->getUser(), $token);
        $loginEvent = new InteractiveLoginEvent($request, $token);
        $this->get('event_dispatcher')->dispatch(SecurityEvents::SWITCH_USER, $loginEvent);

        return $this->render('admin/debug.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function debugUser(SessionStorageInterface $sessionStorage, TokenStorageInterface $tokenStorage, Request $request) {
        $request->getSession()->invalidate();
        $sessionStorage->clear();
        $tokenStorage->setToken(null);
        return $this->redirectToRoute('home');
    }
}
