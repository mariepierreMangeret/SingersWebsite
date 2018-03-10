<?php

namespace SW\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeDisc
 *
 * @ORM\Table(name="sw_type_disc")
 * @ORM\Entity(repositoryClass="SW\PlatformBundle\Repository\TypeDiscRepository")
 */
class TypeDisc
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
     * @ORM\Column(name="title", type="string", length=20)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="SW\PlatformBundle\Entity\Disc", mappedBy="TypeDisc")
     */
    private $discs;

    public function __construct() {
        $this->discs = new ArrayCollection();
    }

    /**
     * @return Collection|Disc[]
     */
    public function GetDiscs() {
        return $this->discs;
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return TypeDesc
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}

