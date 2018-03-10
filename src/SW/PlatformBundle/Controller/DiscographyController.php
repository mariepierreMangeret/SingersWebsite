<?php

namespace SW\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SW\PlatformBundle\Entity\Disc;
use SW\PlatformBundle\Entity\Song;
use SW\PlatformBundle\Entity\TypeDisc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DiscographyController extends Controller
{
    public function discographyAction($id)
    {
        $typediscs = $this
              ->getDoctrine()
              ->getManager()
              ->getRepository('SWPlatformBundle:TypeDisc')
              ->findAll();

        $discs = $this
              ->getDoctrine()
              ->getManager()
              ->getRepository('SWPlatformBundle:Disc')
              ->findByTypedisc($id);

      
        return $this->render('SWPlatformBundle::discography.html.twig', array(
              'typediscs'      => $typediscs, 
              'discs'          => $discs,
              
        ));
    }

    public function viewAction(Disc $discs) 
    {
        return $this->render('SWPlatformBundle::discography_info.html.twig', array(
            'discs' =>  $discs,   
        ));
    }
}

