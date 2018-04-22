<?php

namespace SW\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experience
 *
 * @ORM\Table(name="sw_experience")
 * @ORM\Entity(repositoryClass="SW\PlatformBundle\Repository\ExperienceRepository")
 */
class Experience
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
     * @ORM\Column(name="entitled", type="string", length=255)
     */
    private $entitled;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PlatformBundle\Entity\Section", inversedBy="experiences")
     * @ORM\JoinColumn(nullable=true)
     */
    private $section;


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
     * Set entitled
     *
     * @param string $entitled
     *
     * @return Experience
     */
    public function setEntitled($entitled)
    {
        $this->entitled = $entitled;

        return $this;
    }

    /**
     * Get entitled
     *
     * @return string
     */
    public function getEntitled()
    {
        return $this->entitled;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Experience
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set section
     *
     * @param \SW\PlatformBundle\Entity\Section $section
     *
     * @return Experience
     */
    public function setSection(\SW\PlatformBundle\Entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \SW\PlatformBundle\Entity\Section
     */
    public function getSection()
    {
        return $this->section;
    }
}

