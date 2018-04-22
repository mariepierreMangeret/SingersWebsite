<?php

namespace SW\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SongDisc
 *
 * @ORM\Table(name="sw_song_disc")
 * @ORM\Entity(repositoryClass="SW\PlatformBundle\Repository\SongDiscRepository")
 */
class SongDisc
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
     * @var \SW\PlatformBundle\Entity\Song
     * @ORM\ManyToOne(targetEntity="SW\PlatformBundle\Entity\Song", cascade={"persist"}, fetch="LAZY")
     */
    protected $song;

    /**
     * @ORM\ManyToOne(targetEntity="Disc", inversedBy="SongDisc")
     * @ORM\JoinColumn(name="disc_id", referencedColumnName="id")
     */
    private $disc;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    // /**
    //  * Constructor
    //  */
    // public function __construct()
    // {
    //     $this->discs = new \Doctrine\Common\Collections\ArrayCollection();
    // }

    // /**
    //  * Add disc
    //  *
    //  * @param \SW\PlatformBundle\Entity\Disc $disc
    //  *
    //  * @return Song
    //  */
    // public function addDisc(\SW\PlatformBundle\Entity\Disc $disc)
    // {
    //     $this->discs[] = $disc;

    //     return $this;
    // }

    // /**
    //  * Remove disc
    //  *
    //  * @param \SW\PlatformBundle\Entity\Disc $disc
    //  */
    // public function removeDisc(\SW\PlatformBundle\Entity\Disc $disc)
    // {
    //     $this->discs->removeElement($disc);
    // }

    /**
     * Set song
     *
     * @param \SW\PlatformBundle\Entity\Song $song
     *
     * @return SongDisc
     */
    public function setSong(\SW\PlatformBundle\Entity\Song $song = null)
    {
        $this->song = $song;
        return $this;
    }
    /**
     * Get song
     *
     * @return \SW\PlatformBundle\Entity\Song
     */
    public function getSong()
    {
        return $this->song;
    }

    /**
     * Set disc
     *
     * @param \SW\PlatformBundle\Entity\Disc $disc
     *
     * @return SongDisc
     */
    public function setDisc(\SW\PlatformBundle\Entity\Disc $disc = null)
    {
        $this->disc = $disc;
        return $this;
    }

    /**
     * Get disc
     *
     * @return \SW\PlatformBundle\Entity\Disc
     */
    public function getDisc()
    {
        return $this->disc;
    }
}
