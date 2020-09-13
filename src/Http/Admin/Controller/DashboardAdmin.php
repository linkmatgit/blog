<?php

namespace App\Http\Admin\Controller;

use Symfony\Component\Routing\Annotation\Route;

final class DashboardAdmin extends BaseController
{
    /**
     * @Route("", name="app_dashboard")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [

        ]);
    }
}
