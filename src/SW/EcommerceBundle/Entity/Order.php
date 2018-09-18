<?php

namespace SW\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

 /**
 * Customer
 *
 * @ORM\Table(name="sw_order")
 * @ORM\Entity(repositoryClass="SW\EcommerceBundle\Repository\OrderRepository")
 */
class Order
{

    const STATUS_OPEN = 0; // created but not validated
    const STATUS_PENDING = 1; // waiting from action from the user
    const STATUS_VALIDATED = 2; // the order is validated does not mean the payment is ok
    const STATUS_CANCELLED = 3; // the order is cancelled
    const STATUS_ERROR = 4; // the order has an error
    const STATUS_STOPPED = 5; // use if the subscription has been cancelled/stopped

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
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="delivery_method", type="string", length=255)
     */
    private $deliveryMethod;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", scale=2)
     */
    private $total;

    /**
     * @var float
     *
     * @ORM\Column(name="delivery_cost", type="float", scale=2)
     */
    private $deliveryCost;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_lastname", type="string", length=255)
     */
    private $shippingLastname;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_firstname", type="string", length=255)
     */
    private $shippingFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_phone", type="string", length=255)
     */
    private $shippingPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_adress", type="string", length=255)
     */
    private $shippingAdress;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_city", type="string", length=255)
     */
    private $shippingCity;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_postalcode", type="string", length=255)
     */
    private $shippingPostalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_country", type="string", length=255)
     */
    private $shippingCountry;

    /**
     * @var datetime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="SW\EcommerceBundle\Entity\Customer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    public function __construct()
    {
        $this->updatedAt = new \Datetime();
        $this->createdAt = new \Datetime();
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
     * Set reference
     *
     * @param string $reference
     * @return Order
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
         return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set deliveryMethod
     *
     * @param string $deliveryMethod
     * @return Order
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
     * Set status
     *
     * @param integer $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;
         return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Order
     */
    public function setUsername($username)
    {
        $this->username = $username;
         return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Order
     */
    public function setTotal($total)
    {
        $this->total = $total;
         return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set deliveryCost
     *
     * @param float $deliveryCost
     * @return Order
     */
    public function setDeliveryCost($deliveryCost)
    {
        $this->deliveryCost = $deliveryCost;
         return $this;
    }

    /**
     * Get deliveryCost
     *
     * @return float 
     */
    public function getDeliveryCost()
    {
        return $this->deliveryCost;
    }

    /**
     * Set shippingLastname
     *
     * @param string $shippingLastname
     * @return Order
     */
    public function setShippingLastname($shippingLastname)
    {
        $this->shippingLastname = $shippingLastname;
         return $this;
    }

    /**
     * Get shippingLastname
     *
     * @return string 
     */
    public function getShippingLastname()
    {
        return $this->shippingLastname;
    }

    /**
     * Set shippingFirstname
     *
     * @param string $shippingFirstname
     * @return Order
     */
    public function setShippingFirstname($shippingFirstname)
    {
        $this->shippingFirstname = $shippingFirstname;
         return $this;
    }

    /**
     * Get shippingFirstname
     *
     * @return string 
     */
    public function getShippingFirstname()
    {
        return $this->shippingFirstname;
    }

    /**
     * Set shippingPhone
     *
     * @param string $shippingPhone
     * @return Order
     */
    public function setShippingPhone($shippingPhone)
    {
        $this->shippingPhone = $shippingPhone;
         return $this;
    }

    /**
     * Get shippingPhone
     *
     * @return string 
     */
    public function getShippingPhone()
    {
        return $this->shippingPhone;
    }

    /**
     * Set shippingAdress
     *
     * @param string $shippingAdress
     * @return Order
     */
    public function setShippingAdress($shippingAdress)
    {
        $this->shippingAdress = $shippingAdress;
         return $this;
    }

    /**
     * Get shippingAddress
     *
     * @return string 
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * Set shippingCity
     *
     * @param string $shippingCity
     * @return Order
     */
    public function setShippingCity($shippingCity)
    {
        $this->shippingCity = $shippingCity;
         return $this;
    }

    /**
     * Get shippingCity
     *
     * @return string 
     */
    public function getShippingCity()
    {
        return $this->shippingCity;
    }

    /**
     * Set shippingPostalcode
     *
     * @param string $shippingPostalcode
     * @return Order
     */
    public function setShippingPostalcode($shippingPostalcode)
    {
        $this->shippingPostalcode = $shippingPostalcode;
         return $this;
    }

    /**
     * Get shippingPostalcode
     *
     * @return string 
     */
    public function getShippingPostalcode()
    {
        return $this->shippingPostalcode;
    }

    /**
     * Set shippingCountry
     *
     * @param string $shippingCountry
     * @return Order
     */
    public function setShippingCountry($shippingCountry)
    {
        $this->shippingCountry = $shippingCountry;
         return $this;
    }

    /**
     * Get shippingCountry
     *
     * @return string 
     */
    public function getShippingCountry()
    {
        return $this->shippingCountry;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Order
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
         return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Order
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
         return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set customer
     *
     * @param \SW\EcommerceBundle\Entity\Customer $customer
     * @return Order
     */
    public function setCustomer(\SW\EcommerceBundle\Entity\Customer $customer)
    {
        $this->customer = $customer;
         return $this;
    }

    /**
     * Get customer
     *
     * @return \SW\EcommerceBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}