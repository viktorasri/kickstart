<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudentasController extends Controller
{
    /**
     * @Route("/studentas2", name="studentas")
     */
    public function index()
    {
        return $this->render('studentas/index.html.twig', [
            'klausimu' => 123,
            'sudetingas' => [
                'vienas',
                'du',
                'trys',
                 "visi ' norintys <b>nualaužti</b> puslapi"
            ],
        ]);
    }
}
