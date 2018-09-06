<?php

namespace SW\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CatalogController extends Controller
{
    public function indexAction(Request $request)
    {
    	$products = $this
	    	->getDoctrine()
	    	->getManager()
	    	->getRepository('SWEcommerceBundle:Product')
	    	->findAll();

        return $this->render('SWEcommerceBundle:Catalog:index.html.twig', array(
        	'products'			=> $products,
        ));
    }
}
