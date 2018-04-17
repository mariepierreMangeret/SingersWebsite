<?php

namespace SW\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SW\PlatformBundle\Entity\Contact;
use SW\UserBundle\Entity\User;
use SW\PlatformBundle\Form\ContactType;
use SW\PlatformBundle\Form\ProfileType;
use Symfony\Component\HttpFoundation\Request;
use SW\PlatformBundle\Entity\News;
use SW\PlatformBundle\Entity\Section;
use SW\PlatformBundle\Entity\Experience;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\Tools\Pagination\Paginator;


class PlatformController extends Controller
{
    public function indexAction(Request $request)
    {
        $nbPerPage = 4;

        $news = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('SWPlatformBundle:News')
          ->myNewsIndex($nbPerPage);

        return $this->render('SWPlatformBundle::index.html.twig', array(
              'news'      => $news,

        ));
    }

    public function contactAction(Request $request)
    {
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm('SW\PlatformBundle\Form\ContactType',null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('sw_platform_contact'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                // Send mail
                if($this->sendEmail($form->getData())){

                    $request->getSession()->getFlashBag()->add('notice', 'Message bien envoyé.');
                    // Everything OK, redirect to wherever you want ! :
                    
                    return $this->redirectToRoute('sw_platform_contact');
                }else{
                    // An error ocurred, handle
                    var_dump("Error");
                }
            }
        }

        return $this->render('SWPlatformBundle::contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function biographyAction(Request $request)
    {
        $sections = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('SWPlatformBundle:Section')
            ->findAll();

        return $this->render('SWPlatformBundle::biography.html.twig', array(
              'sections'      => $sections, 

        ));
    }

    public function profileAction(Request $request, $id)
    {
        $profile = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('SWUserBundle:User')
            ->find($id);

        if (null === $profile) {
            throw new NotFoundHttpException("Le profil n'existe pas.");
        }

        $form = $this->createForm('SW\PlatformBundle\Form\ProfileType', $profile);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Modification bien enregistré');

            return $this->redirect($this->generateUrl('sw_platform_profile', array('id' => $profile->getId())));
        }

        return $this->render('SWPlatformBundle::profile.html.twig', array(
              'profile'      => $profile, 
              'form'         => $form->createView(),
        )); 
    }
}