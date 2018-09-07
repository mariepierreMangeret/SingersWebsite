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

    public function getTotal()
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
}
