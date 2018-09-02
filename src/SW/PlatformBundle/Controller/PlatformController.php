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
use SW\PlatformBundle\Entity\Video;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\Tools\Pagination\Paginator;


class PlatformController extends Controller
{
    public function indexAction(Request $request)
    {
        $nbPerPage = 3;

        $nbVideosPerPage = 4;

        $news = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('SWPlatformBundle:News')
          ->myNewsIndex($nbPerPage);

        $videos = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('SWPlatformBundle:Video')
          ->myVideosIndex($nbVideosPerPage);

        return $this->render('SWPlatformBundle::index.html.twig', array(
            'news'      => $news,
            'videos'     => $videos,
        ));
    }

    public function contactAction(Request $request)
    {
        $form = $this->createForm('SW\PlatformBundle\Form\ContactType',null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('sw_platform_contact'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if($form->isValid()){
                $message = (new \Swift_Message('Formulaire de contact'))
                  ->setFrom('b.noemie.music@gmail.com')
                  ->setTo('b.noemie.music@gmail.com')
                  ->setBody(
                      $this->renderView(
                          // app/Resources/views/emails/contact.html.twig
                          'emails/contact.html.twig',
                          array(
                            'name'     => $form["name"]->getData(),
                            'email'    => $form["email"]->getData(),
                            'subject'  => $form["subject"]->getData(),
                            'message'  => $form["message"]->getData()
                        )
                      ),
                      'text/html'
                  )
                ;

                $this->get('mailer')->send($message);
                unset($form);
                $request->getSession()->getFlashBag()->add('notice', 'Message bien envoyé.');
                $form = $this->createForm('SW\PlatformBundle\Form\ContactType',null,array(
                    // To set the action use $this->generateUrl('route_identifier')
                    'action' => $this->generateUrl('sw_platform_contact'),
                    'method' => 'POST'
                ));
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