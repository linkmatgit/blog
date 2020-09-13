<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * Retourne la page d'acceuil
     * @Route("/", name="app_home")
     */
    public function index()
    {
        return $this->render('page/index.html.twig', [
        ]);
    }
    /**
     * Retourne la page de contact
     * @Route("/contact", name="app_contact")
     */

    public function contact(){

        return $this->render('page/contact.html.twig');
    }
}
