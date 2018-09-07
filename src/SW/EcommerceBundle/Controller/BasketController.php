<?php

namespace SW\EcommerceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use SW\EcommerceBundle\Entity\Customer;
use SW\EcommerceBundle\Entity\Basket;
use SW\EcommerceBundle\Entity\BasketElement;

 class BasketController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $customer = $em->getRepository('SWEcommerceBundle:Customer')->findOneByUser($this->get('security.token_storage')->getToken()->getUser());

        $basket = $em->getRepository('SWEcommerceBundle:Basket')->findOneByCustomer($customer);
        
        return $this->render('SWEcommerceBundle:Basket:index.html.twig', array(
            'basket'    => $basket,
        ));
    }

    public function addProductAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $customer = $em->getRepository('SWEcommerceBundle:Customer')->findOneByUser($this->get('security.token_storage')->getToken()->getUser());

         if ( is_null($customer) ) {
            $customer = new Customer($this->get('security.token_storage')->getToken()->getUser());
            $basket = new Basket($customer);
            $em->persist($customer);
         } else {
            $basket = $em->getRepository('SWEcommerceBundle:Basket')->findOneByCustomer($customer);
        }

        $product = $em->getRepository('SWEcommerceBundle:Product')->find($request->request->getInt('product_id'));

        $basketElement = $em->getRepository('SWEcommerceBundle:BasketElement')->findOneByProduct($product);

        if ( is_null($basketElement) ) {
            $basketElement = new BasketElement($product);
            $basket->addBasketElement($basketElement);
        }

        if ( $request->request->getInt('product_quantity') == 0 || is_null($request->request->getInt('product_quantity')) ) 
            $quantity = 1;
        else
            $quantity = $request->request->getInt('product_quantity');
        if ( $basketElement->getProduct()->getStock() >= $basketElement->getQuantity()+$quantity ) {
            $basketElement->addQuantity($quantity);
            $em->persist($basketElement);
            $em->persist($basket);
            $em->flush();
        } else {
            $request->getSession()->getFlashBag()->add('error', $this->get('translator')->trans('basket.sold_out'));
        }

        return new RedirectResponse($this->generateUrl('sw_ecommerce_shop_basket'));
    }

 	public function removeProductAction(Request $request, BasketElement $basketElement)
    {
        $em = $this->getDoctrine()->getManager();

        $basket = $em->getRepository('SWEcommerceBundle:Basket')->findOneByUser($this->get('security.token_storage')->getToken()->getUser());

        $basket->removeBasketElement($basketElement);
        $em->remove($basketElement);
        $em->persist($basket);
        $em->flush();

        return new RedirectResponse($this->generateUrl('sw_ecommerce_shop_basket'));
    }

    public function resetAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $basket = $em->getRepository('SWEcommerceBundle:Basket')->findOneByUser($this->get('security.token_storage')->getToken()->getUser());

        foreach ($basket->getBasketElements() as $basketElement) {
            $basket->removeBasketElement($basketElement);
            $em->remove($basketElement);
        }

        $em->persist($basket);
        $em->flush();

        return new RedirectResponse($this->generateUrl('sw_ecommerce_shop_basket'));
    }
} 