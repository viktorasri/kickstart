<?php

namespace App\Controller;

use App\Entity\User;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index(GoogleAuthenticatorInterface $twoFactor, Request $request)
    {

        $secret = $twoFactor->generateSecret();
        $user = new User();
        $url = $twoFactor->getUrl($user);

        $code = $request->get('code');
        $valid = false;
        if ($code) {
            $valid = $twoFactor->checkCode($user, $code);
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'url' => $url,
            'code' => $code,
            'valid' => $valid,
        ]);
    }
}
