<?php

namespace SW\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderElement
 *
 * @ORM\Table(name="sw_order_element")
 * @ORM\Entity(repositoryClass="SW\EcommerceBundle\Repository\OrderElementRepository")
 */
class OrderElement
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
     * @var string
     *
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
      * @ORM\ManyToOne(targetEntity="SW\EcommerceBundle\Entity\Order", cascade={"persist"}, inversedBy="orderElements")
      * @ORM\JoinColumn(nullable=false)
      */
    private $order;

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
     * @return OrderElement
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
     * Set quantity.
     *
     * @param int $quantity
     *
     * @return OrderElement
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
     * Set order
     *
     * @param \SW\EcommerceBundle\Entity\Order $order
     * @return OrderElement
     */
    public function setOrder(\SW\EcommerceBundle\Entity\Order $order)
    {
        $this->order = $order;
         return $this;
    }

    /**
     * Get order
     *
     * @return \SW\EcommerceBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
