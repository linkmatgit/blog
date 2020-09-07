<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * Retourne la page d'acceuil
     * @Route("/", name="page")
     */
    public function index()
    {
        return $this->render('page/index.html.twig', [
        ]);
    }
}
