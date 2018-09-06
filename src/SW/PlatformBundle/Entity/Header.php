<?php

namespace SW\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Header
 *
 * @ORM\Table(name="sw_header")
 * @ORM\Entity(repositoryClass="SW\PlatformBundle\Repository\HeaderRepository")
 */
class Header
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
     * @ORM\Column(name="titleOne", type="string", length=255)
     */
    private $titleOne;

    /**
     * @var string
     *
     * @ORM\Column(name="titleTwo", type="string", length=255)
     */
    private $titleTwo;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    private $image;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    private $video;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */

    private $imageBann;
    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    private $imageAdd;

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
     * Set titleOne.
     *
     * @param string $titleOne
     *
     * @return Header
     */
    public function setTitleOne($titleOne)
    {
        $this->titleOne = $titleOne;

        return $this;
    }

    /**
     * Get titleOne.
     *
     * @return string
     */
    public function getTitleOne()
    {
        return $this->titleOne;
    }

    /**
     * Set titleTwo.
     *
     * @param string $titleTwo
     *
     * @return Header
     */
    public function setTitleTwo($titleTwo)
    {
        $this->titleTwo = $titleTwo;

        return $this;
    }

    /**
     * Get titleTwo.
     *
     * @return string
     */
    public function getTitleTwo()
    {
        return $this->titleTwo;
    }

    /**
     * Set image.
     *
     * @param MediaInterface $image
     *
     * @return Header
     */
    public function setImage(MediaInterface $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return MediaInterface
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set video.
     *
     * @param MediaInterface $video
     *
     * @return Header
     */
    public function setVideo(MediaInterface $video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video.
     *
     * @return MediaInterface
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set imageBann.
     *
     * @param MediaInterface $imageBann
     *
     * @return Header
     */
    public function setImageBann(MediaInterface $imageBann)
    {
        $this->imageBann = $imageBann;

        return $this;
    }

    /**
     * Get imageBann.
     *
     * @return MediaInterface
     */
    public function getImageBann()
    {
        return $this->imageBann;
    }

    /**
     * Set imageAdd.
     *
     * @param MediaInterface $imageAdd
     *
     * @return Header
     */
    public function setImageAdd(MediaInterface $imageAdd)
    {
        $this->imageAdd = $imageAdd;

        return $this;
    }

    /**
     * Get imageAdd.
     *
     * @return MediaInterface
     */
    public function getImageAdd()
    {
        return $this->imageAdd;
    }
}
