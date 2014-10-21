<?php

namespace Brix\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Navigation
 *
 * @ORM\Table(name="brix_core_navigation")
 * @ORM\Entity
 */
class Navigation
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
     * @ORM\Column(name="name", type="string",length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="classes", type="string",length=255, nullable=true)
     */
    private $classes;

    /**
     * @var string
     *
     * @ORM\Column(name="dom_id", type="string",length=255, nullable=true)
     */
    private $domid;

    /**
    *
    * @ORM\ManyToOne(targetEntity="Navigation")
    * @ORM\JoinColumn(name="original_id", nullable=true)
    */
    private $original;

    /**
    *
    * @ORM\ManyToOne(targetEntity="Language")
    * @ORM\JoinColumn(name="language_id", nullable=true)
    */
    private $language;


    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="NavigationElement", mappedBy="navigation")
     */
    private $elements;


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
     * Set name
     *
     * @param string $name
     * @return Navigation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set original
     *
     * @param \Brix\CoreBundle\Entity\Navigation $original
     * @return Navigation
     */
    public function setOriginal(\Brix\CoreBundle\Entity\Navigation $original = null)
    {
        $this->original = $original;

        return $this;
    }

    /**
     * Get original
     *
     * @return \Brix\CoreBundle\Entity\Navigation
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * Set language
     *
     * @param \Brix\CoreBundle\Entity\Language $language
     * @return Navigation
     */
    public function setLanguage(\Brix\CoreBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Brix\CoreBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set classes
     *
     * @param string $classes
     * @return Navigation
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

    /**
     * Set domid
     *
     * @param string $domid
     * @return Navigation
     */
    public function setDomid($domid)
    {
        $this->domid = $domid;

        return $this;
    }

    /**
     * Get domid
     *
     * @return string
     */
    public function getDomid()
    {
        return $this->domid;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->elements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add elements
     *
     * @param \Brix\CoreBundle\Entity\NavigationElement $elements
     * @return Navigation
     */
    public function addElement(\Brix\CoreBundle\Entity\NavigationElement $elements)
    {
        $this->elements[] = $elements;

        return $this;
    }

    /**
     * Remove elements
     *
     * @param \Brix\CoreBundle\Entity\NavigationElement $elements
     */
    public function removeElement(\Brix\CoreBundle\Entity\NavigationElement $elements)
    {
        $this->elements->removeElement($elements);
    }

    /**
     * Get elements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getElements()
    {
        return $this->elements;
    }
}
