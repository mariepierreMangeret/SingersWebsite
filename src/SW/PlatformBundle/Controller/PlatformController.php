<?php

namespace SW\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SW\PlatformBundle\Entity\Contact;
use SW\PlatformBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class PlatformController extends Controller
{
    public function indexAction()
    {
        return $this->render('SWPlatformBundle::index.html.twig');
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

    private function sendEmail($data){
        $myappContactMail = 'mangeret.mariepierre@gmail.com';
        $myappContactPassword = '1fa0486ac0435b';
        
        $transport = \Swift_SmtpTransport::newInstance('smtp.mailtrap.io', 2525)->setUsername('812b85f4da636c')->setPassword('1fa0486ac0435b');

        $mailer = \Swift_Mailer::newInstance($transport);
        $message = \Swift_Message::newInstance($data["subject"])
        ->setFrom(array($myappContactMail => "Message de ".$data["name"]))
        ->setTo(array(
            $myappContactMail => $myappContactMail
        ))
        ->setBody($data["message"]."<br/> Envoyé par :".$data["email"]);
        
        return $mailer->send($message);
    }
}
