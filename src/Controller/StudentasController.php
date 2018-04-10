<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudentasController extends Controller
{
    /**
     * @Route("/studentas", name="studentas")
     */
    public function index()
    {
        return $this->render('studentas/index.html.twig', [
            'controller_name' => 'StudentasController',
        ]);
    }
}
