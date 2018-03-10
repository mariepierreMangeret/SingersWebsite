<?php

namespace SW\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disc
 *
 * @ORM\Table(name="sw_disc")
 * @ORM\Entity(repositoryClass="SW\PlatformBundle\Repository\DiscRepository")
 */
class Disc
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
     * @var string
     *
     * @ORM\Column(name="image", type="blob")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="information", type="string", length=255)
     */
    private $information;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PlatformBundle\Entity\TypeDisc", inversedBy="discs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $typedisc;

    /**
     * @ORM\ManyToMany(targetEntity="SW\PlatformBundle\Entity\Song", mappedBy="discs")
     */
    private $songs;

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
     * @return Disque
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
     * Set image
     *
     * @param string $image
     *
     * @return Disque
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set information
     *
     * @param string $information
     *
     * @return Disque
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

   

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->songs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set typedisc
     *
     * @param \SW\PlatformBundle\Entity\TypeDisc $typedisc
     *
     * @return Disc
     */
    public function setTypedisc(\SW\PlatformBundle\Entity\TypeDisc $typedisc = null)
    {
        $this->typedisc = $typedisc;

        return $this;
    }

    /**
     * Get typedisc
     *
     * @return \SW\PlatformBundle\Entity\TypeDisc
     */
    public function getTypedisc()
    {
        return $this->typedisc;
    }

    /**
     * Add song
     *
     * @param \SW\PlatformBundle\Entity\Disc $song
     *
     * @return Disc
     */
    public function addSong(\SW\PlatformBundle\Entity\Disc $song)
    {
        $this->songs[] = $song;

        return $this;
    }

    /**
     * Remove song
     *
     * @param \SW\PlatformBundle\Entity\Disc $song
     */
    public function removeSong(\SW\PlatformBundle\Entity\Disc $song)
    {
        $this->songs->removeElement($song);
    }

    /**
     * Get songs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSongs()
    {
        return $this->songs;
    }
}
