<?php

namespace volunteerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@volunteer/Default/index.html.twig');
    }
}
