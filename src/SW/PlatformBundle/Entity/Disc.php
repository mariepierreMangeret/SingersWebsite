<?php

namespace SW\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    private $imageMin;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
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
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="SW\PlatformBundle\Entity\SongDisc", mappedBy="disc", cascade={"remove","persist"})
     */
    private $songs;

    /**
     * @var string
     *
     * @ORM\Column(name="urlAmazon", type="string", length=255, nullable=true)
     */
    private $urlAmazon;

    /**
     * @var string
     *
     * @ORM\Column(name="urlItunes", type="string", length=255, nullable=true)
     */
    private $urlItunes;

    /**
     * @var string
     *
     * @ORM\Column(name="urlShop", type="string", length=255, nullable=true)
     */
    private $urlShop;

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
     * @return Disc
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
     * Set imageMin
     *
     * @param MediaInterface $imageMin
     *
     * @return Disc
     */
    public function setImageMin(MediaInterface $imageMin)
    {
        $this->imageMin = $imageMin;

        return $this;
    }

    /**
     * Get imageMin
     *
     * @return MediaInterface
     */
    public function getImageMin()
    {
        return $this->imageMin;
    }

    /**
     * Set image
     *
     * @param MediaInterface $image
     *
     * @return Disc
     */
    public function setImage(MediaInterface $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return MediaInterface
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
     * @return Disc
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
     * @param \SW\PlatformBundle\Entity\SongDisc $song
     *
     * @return Disc
     */
    public function addSong(\SW\PlatformBundle\Entity\SongDisc $song)
    {
        $this->songs[] = $song;
        $song->setDisc($this);

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

    /**
     * Set urlAmazon
     *
     * @param string $urlAmazon
     *
     * @return Disc
     */
    public function setUrlAmazon($urlAmazon)
    {
        $this->urlAmazon = $urlAmazon;

        return $this;
    }

    /**
     * Get urlAmazon
     *
     * @return string
     */
    public function getUrlAmazon()
    {
        return $this->urlAmazon;
    }

    /**
     * Set urlItunes
     *
     * @param string $urlItunes
     *
     * @return Disc
     */
    public function setUrlItunes($urlItunes)
    {
        $this->urlItunes = $urlItunes;

        return $this;
    }

    /**
     * Get urlItunes
     *
     * @return string
     */
    public function getUrlItunes()
    {
        return $this->urlItunes;
    }

    /**
     * Set urlShop
     *
     * @param string $urlShop
     *
     * @return Disc
     */
    public function setUrlShop($urlShop)
    {
        $this->urlShop = $urlShop;

        return $this;
    }

    /**
     * Get urlShop
     *
     * @return string
     */
    public function getUrlShop()
    {
        return $this->urlShop;
    }
}
