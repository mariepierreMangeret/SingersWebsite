<?php

namespace SW\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
{
	public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
        
        $customer = $em->getRepository('SWEcommerceBundle:Customer')->findOneByUser($this->get('security.token_storage')->getToken()->getUser());

        $orders = $em->getRepository('SWEcommerceBundle:Order')->findByCustomer($customer);
        
        return $this->render('SWPlatformBundle::list_orders.html.twig', array(
        	'orders'	=> $orders
        ));
    }
} 