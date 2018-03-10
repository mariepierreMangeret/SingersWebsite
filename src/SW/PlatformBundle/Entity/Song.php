<?php

namespace SW\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Song
 *
 * @ORM\Table(name="sw_song")
 * @ORM\Entity(repositoryClass="SW\PlatformBundle\Repository\SongRepository")
 */
class Song
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="SW\PlatformBundle\Entity\Disc", inversedBy="songs")
     */
    private $discs;


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
     * @return Song
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->discs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add disc
     *
     * @param \SW\PlatformBundle\Entity\Disc $disc
     *
     * @return Song
     */
    public function addDisc(\SW\PlatformBundle\Entity\Disc $disc)
    {
        $this->discs[] = $disc;

        return $this;
    }

    /**
     * Remove disc
     *
     * @param \SW\PlatformBundle\Entity\Disc $disc
     */
    public function removeDisc(\SW\PlatformBundle\Entity\Disc $disc)
    {
        $this->discs->removeElement($disc);
    }

    /**
     * Get discs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiscs()
    {
        return $this->discs;
    }
}
