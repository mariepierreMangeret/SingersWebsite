<?php

namespace SW\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function viewAction($productId, $slug)
    {
    	$product = $this
	    	->getDoctrine()
	    	->getManager()
	    	->getRepository('SWEcommerceBundle:Product')
	    	->findEnabledFromIdAndSlug($productId, $slug);

        if (!$product) {
            throw new NotFoundHttpException(sprintf('Unable to find the product with id=%d', $productId));
        }

        return $this->render('SWEcommerceBundle:Product:view.html.twig', array(
        	'product'		=> $product,
        ));
    }
}
