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
use SW\EcommerceBundle\Entity\Order;
use SW\EcommerceBundle\Entity\OrderElement;
use SW\UserBundle\Entity\User;
use SW\EcommerceBundle\Form\UserAdressType;

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

    public function resetAction()
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

     public function deliveryAddressStepAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $form = $this->createForm('SW\EcommerceBundle\Form\UserAdressType', $user);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Modification bien enregistré');

            return $this->redirect($this->generateUrl('sw_ecommerce_shop_basket_delivery_address', array('id' => $user->getId())));
        }


        return $this->render('SWEcommerceBundle:Basket:delivery_address_step.html.twig', array(
            'form'  => $form->createView(),
        ));
    }

    public function deliveryStepAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $basket = $em->getRepository('SWEcommerceBundle:Basket')->findOneByUser($this->get('security.token_storage')->getToken()->getUser());  

        $laposteCurl = curl_init();
        curl_setopt($laposteCurl, CURLOPT_URL, 'https://api.laposte.fr/tarifenvoi/v1?type=colis&poids='.$basket->getTotalWeight());
        curl_setopt($laposteCurl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($laposteCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($laposteCurl, CURLOPT_HTTPHEADER, array(
            'X-Okapi-Key: '.$this->container->getParameter('X-Okapi-Key')
        ));


        $laposteApiResponse = curl_exec($laposteCurl);
        curl_close($laposteCurl);
        $laposteApiResponse = json_decode($laposteApiResponse);
        $deliveryMethods = array();

        $deliveryMethods["Laposte"] = array(
            "price"         =>  $laposteApiResponse[1]->price,
            "location"      =>  $this->get('translator')->trans('basket.only_france'),
            "delivery_time" =>  '2 - 4',
        );

        if ( $request->request->get('delivery-method') ) {
            $basket->setDeliveryMethod($request->request->get('delivery-method'));
            $basket->setShippingFee($deliveryMethods[$request->request->get('delivery-method')]['price']);
            $em->persist($basket);
            $em->flush();
            
            return new RedirectResponse($this->generateUrl('sw_ecommerce_shop_basket_payment'));
        }

        return $this->render('SWEcommerceBundle:Basket:delivery_step.html.twig', [
            'deliveryMethods'   => $deliveryMethods,
        ]);
    }

    public function paymentStepAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $basket = $em->getRepository('SWEcommerceBundle:Basket')->findOneByUser($this->get('security.token_storage')->getToken()->getUser());

        return $this->render('SWEcommerceBundle:Basket:payment_step.html.twig', array(
            'basket'            => $basket,
            'user'              => $user,
        ));
    }

    public function transformIntoOrderAction(Request $request, $reference)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $customer = $em->getRepository('SWEcommerceBundle:Customer')->findOneByUser($user);
        $basket = $em->getRepository('SWEcommerceBundle:Basket')->findOneByCustomer($customer);
        
        $order = new Order();

        $order->setReference($reference);
        $order->setDeliveryMethod($basket->getDeliveryMethod());
        $order->setStatus(Order::STATUS_VALIDATED);
        $order->setUsername($customer->getUser()->getUsername());
        $order->setTotal($basket->getTotalPrice());
        $order->setDeliveryCost($basket->getShippingFee());
        
        $order->setShippingLastname($user->getLastname());
        $order->setShippingFirstname($user->getFirstname());
        $order->setShippingPhone($user->getPhone());
        $order->setShippingAdress($user->getAdress());
        $order->setShippingCity($user->getCity());
        $order->setShippingPostalcode($user->getPostalcode());
        $order->setShippingCountry($user->getCountry());
        
        $order->setCustomer($customer);

        foreach( $basket->getBasketElements() as $basketElement ) {
            $orderElement = new OrderElement();
            $orderElement->setProduct($basketElement->getProduct());
            $orderElement->setQuantity($basketElement->getQuantity());
            $order->addOrderElement($orderElement);
        }

        $em->persist($order);
        $em->flush();

        $this-> resetAction();
        
        return new RedirectResponse($this->generateUrl('sw_ecommerce_shop_user_order'));
    }
} 