<?php

namespace SW\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlatformController extends Controller
{
    public function indexAction()
    {
        return $this->render('SWPlatformBundle::index.html.twig');
    }
}
