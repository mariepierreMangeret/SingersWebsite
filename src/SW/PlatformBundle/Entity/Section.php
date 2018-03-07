<?php

namespace SW\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Section
 *
 * @ORM\Table(name="sw_section")
 * @ORM\Entity(repositoryClass="SW\PlatformBundle\Repository\SectionRepository")
 */
class Section
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
     * @ORM\OneToMany(targetEntity="SW\PlatformBundle\Entity\Experience", mappedBy="section")
     */
    private $experiences;

    public function __construct() {
        $this->experiences = new ArrayCollection();
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences() {
        return $this->experiences;
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
     * @return Section
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

