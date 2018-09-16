<?php

namespace SW\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Basket
 *
 * @ORM\Table(name="sw_basket")
 * @ORM\Entity(repositoryClass="SW\EcommerceBundle\Repository\BasketRepository")
 */
class Basket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="SW\EcommerceBundle\Entity\BasketElement", cascade={"persist"}, mappedBy="basket")
     */
    private $basketElements;

    /**
     * @ORM\OneToOne(targetEntity="SW\EcommerceBundle\Entity\Customer", cascade={"persist"})
      * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @var int
     *
     * @ORM\Column(name="delivery_address_id", type="integer")
     */
    private $deliveryAddressId;
     /**
     * @var string
     *
     * @ORM\Column(name="delivery_method", type="string", length=255)
     */
    private $deliveryMethod;
     /**
     * @var float
     *
     * @ORM\Column(name="shipping_fee", type="float", scale=2)
     */
    private $shippingFee;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add basketElements
     *
     * @param \SW\EcommerceBundle\Entity\BasketElement $basketElements
     * @return Basket
     */
    public function addBasketElement(\SW\EcommerceBundle\Entity\BasketElement $basketElements)
    {
        $this->basketElements[] = $basketElements;
         $basketElements->setBasket($this);
         return $this;
    }

    /**
     * Remove basketElements
     *
     * @param \SW\EcommerceBundle\Entity\BasketElement $basketElements
     */
    public function removeBasketElement(\SW\EcommerceBundle\Entity\BasketElement $basketElements)
    {
        $this->basketElements->removeElement($basketElements);
    }

    /**
     * Get basketElements.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBasketElements()
    {
        return $this->basketElements;
    }

    public function getTotalPrice()
    {
        $total = 0;
        foreach ( $this->getBasketElements() as $basketElement ) {
            $total += $basketElement->getTotal();
        }
         return $total;
    }

    /**
     * Set customer.
     *
     * @param \SW\EcommerceBundle\Entity\Customer $customer
     *
     * @return Basket
     */
    public function setCustomer(\SW\EcommerceBundle\Entity\Customer $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer.
     *
     * @return \SW\EcommerceBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set deliveryAddressId
     *
     * @param integer $deliveryAddressId
     * @return Basket
     */
    public function setDeliveryAddressId($deliveryAddressId)
    {
        $this->deliveryAddressId = $deliveryAddressId;
         return $this;
    }

    /**
     * Get deliveryAddressId
     *
     * @return integer
     */
    public function getDeliveryAddressId()
    {
        return $this->deliveryAddressId;
    }

    /**
     * Set deliveryMethod
     *
     * @param string $deliveryMethod
     * @return Basket
     */
    public function setDeliveryMethod($deliveryMethod)
    {
        $this->deliveryMethod = $deliveryMethod;
         return $this;
    }

    /**
     * Get deliveryMethod
     *
     * @return string
     */
    public function getDeliveryMethod()
    {
        return $this->deliveryMethod;
    }

    /**
     * Set shippingFee
     *
     * @param float $shippingFee
     * @return Basket
     */
    public function setShippingFee($shippingFee)
    {
        $this->shippingFee = $shippingFee;
         return $this;
    }

    /**
     * Get shippingFee
     *
     * @return float
     */
    public function getShippingFee()
    {
        return $this->shippingFee;
    }

    public function getTotalWeight()
    {
        $total = 0;
        foreach ( $this->getBasketElements() as $basketElement ) {
            $total += $basketElement->getTotalWeight();
        }
        return $total;
    }
}
