<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardAdmin extends BaseController
{
    /**
     * @Route(" ", name="dashboard")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [

        ]);
    }
}
