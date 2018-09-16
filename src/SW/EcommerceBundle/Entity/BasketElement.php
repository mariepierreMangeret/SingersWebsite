<?php

namespace SW\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BasketElement
 *
 * @ORM\Table(name="sw_basket_element")
 * @ORM\Entity(repositoryClass="SW\EcommerceBundle\Repository\BasketElementRepository")
 */
class BasketElement
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
     * @ORM\ManyToOne(targetEntity="SW\EcommerceBundle\Entity\Product", cascade={"persist"})
      * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity = 0;

    /**
     * @ORM\ManyToOne(targetEntity="SW\EcommerceBundle\Entity\Basket", cascade={"persist"}, inversedBy="basketElements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $basket;

    public function __construct($product)
    {
        $this->product = $product;
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
     * Set product.
     *
     * @param \SW\EcommerceBundle\Entity\Product $product
     *
     * @return BasketElement
     */
    public function setProduct(\SW\EcommerceBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return \SW\EcommerceBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param integer $quantity
     * @return BasketElement
     */
    public function addQuantity($quantity)
    {
        $this->quantity += $quantity;
         return $this;
    }

    /**
     * Set quantity.
     *
     * @param int $quantity
     *
     * @return BasketElement
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set basket.
     *
     * @param \SW\EcommerceBundle\Entity\Basket $basket
     *
     * @return BasketElement
     */
    public function setBasket(\SW\EcommerceBundle\Entity\Basket $basket)
    {
        $this->basket = $basket;

        return $this;
    }

    /**
     * Get basket.
     *
     * @return \SW\EcommerceBundle\Entity\Basket
     */
    public function getBasket()
    {
        return $this->basket;
    }

    public function getTotalPrice()
    {
        return bcmul($this->product->getPrice(), $this->quantity);
    }

    public function getTotalWeight()
    {
        return bcmul($this->product->getWeight(), $this->quantity);
    }
}
