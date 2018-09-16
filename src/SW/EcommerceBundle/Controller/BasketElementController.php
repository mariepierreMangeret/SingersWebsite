<?php

namespace SW\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use SW\EcommerceBundle\Entity\BasketElement;

class BasketElementController extends Controller
{
    public function setQuantityAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $basketElementId = $this->get('request')->request->get('id');

        $quantity = $this->get('request')->request->get('quantity');

        $basketElement = $em->getRepository('SWEcommerceBundle:BasketElement')->find($basketElementId);

        $basketElement->setQuantity($quantity);
        $em->persist($basketElement);
        $em->flush();
        
        $response = new Response();
        $response->setContent(json_encode(array("success"=>true, "total"=>$basketElement->getBasket()->getTotal())));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
}