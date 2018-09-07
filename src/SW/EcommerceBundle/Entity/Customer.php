<?php

namespace SW\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SW\UserBundle\Entity\User;

/**
 * Customer
 *
 * @ORM\Table(name="sw_customer")
 * @ORM\Entity(repositoryClass="SW\EcommerceBundle\Repository\CustomerRepository")
 */
class Customer
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
     * @ORM\ManyToOne(targetEntity="SW\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct($user) {
        $this->user = $user;
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
     * Set user.
     *
     * @param \SW\UserBundle\Entity\User $user
     *
     * @return Customer
     */
    public function setUser(\SW\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \SW\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
