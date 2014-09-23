<?php

namespace Brix\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Media
 *
 * @ORM\Table(name="brix_core_media")
 * @ORM\Entity
 */
class Media
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
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255)
     */
    private $source;

    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer",nullable=true)
     */
    private $width;

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer",nullable=true)
     */
    private $height;


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
     * Set source
     *
     * @param string $source
     * @return Media
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return Media
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Media
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }
    public function getAbsolutePath()
    {
        return null === $this->source
            ? null
            : $this->getUploadRootDir().'/'.$this->source;
    }

    /**
     * @JMS\VirtualProperty()
     * @JMS\SerializedName("url")
     * @JMS\Type("string")
     */
    public function getWebPath()
    {
        return null === $this->source
            ? null
            : $this->getUploadDir().'/'.$this->source;
    }

    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return '/uploads/documents';
    }

    public function __toString(){
      return strval($this->getId());
    }
}
