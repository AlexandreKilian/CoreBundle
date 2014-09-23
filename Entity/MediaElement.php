<?php

namespace Brix\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MediaElement
 *
 * @ORM\Table(name="brix_core_media_element")
 * @ORM\Entity
 */
class MediaElement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="media", type="integer")
     */
    private $media;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="classes", type="string", length=255)
     */
    private $classes;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set media
     *
     * @param integer $media
     * @return MediaElement
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return integer
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return MediaElement
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set classes
     *
     * @param string $classes
     * @return MediaElement
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * Get classes
     *
     * @return string
     */
    public function getClasses()
    {
        return $this->classes;
    }
}
