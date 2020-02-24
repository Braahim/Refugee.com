<?php

namespace DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Dashboard/Default/index.html.twig');
    }

    public function dashboardAction()
    {
        return $this->render('@Dashboard/Dashboard/dashboard.html.twig');
    }
}
