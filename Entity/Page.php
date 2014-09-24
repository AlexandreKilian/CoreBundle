<?php

namespace Brix\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
* Page
*
* @ORM\Table(name="brix_core_page")
* @ORM\Entity
*/
class Page
{
  /**
  * @var integer
  *
  * @ORM\Column(name="id", type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  * @JMS\Groups({"details","list"})
  */
  private $id;

  /**
  * @var string
  *
  * @ORM\Column(name="name", type="string", length=255)
  * @JMS\Groups({"details","list"})
  */
  private $name;

  /**
  * @var string
  *
  * @ORM\Column(name="url", type="string", length=255, nullable=true)
  * @JMS\Groups({"details","list"})
  */
  private $url;

  /**
  * @var string
  *
  * @ORM\OneToMany(targetEntity="Page", mappedBy="parent")
  * @JMS\Groups({"details","list"})
  */
  private $children;

  /**
  *
  * @ORM\ManyToOne(targetEntity="Page", inversedBy="children")
  * @ORM\JoinColumn(name="parent_id", nullable=true)
  * @JMS\Groups({"list","details"})
  */
  private $parent;

  /**
  *
  * @ORM\ManyToOne(targetEntity="Page")
  * @ORM\JoinColumn(name="original_id", nullable=true)
  * @JMS\Groups({"details"})
  */
  private $original;

  /**
  *
  * @ORM\ManyToOne(targetEntity="Language")
  * @ORM\JoinColumn(name="language_id", nullable=true)
  * @JMS\Accessor(getter="getLanguageArray")
  * @JMS\Groups({"details","list"})
  * @JMS\Type("array")
  */
  private $language;


  /**
  * @ORM\Column(name="homepage",type="boolean")
  */
  private $isHomepage = false;


  /**
  * @var string
  *
  * @ORM\OneToMany(targetEntity="Block", mappedBy="page")
  * @JMS\Groups({"details"})
  */
  private $blocks;

  /**
  * @var string
  *
  * @ORM\ManyToOne(targetEntity="PageType")
  * @ORM\JoinColumn(name="page_type")
  * @JMS\Accessor(getter="getTypeId")
  * @JMS\Type("integer")
  * @JMS\Groups({"details"})
  */
  private $type;

  /**
  * @ORM\Column(name="entity", type="integer", nullable=true)
  *
  */
  private $entity;

  /**
  * Constructor
  */
  public function __construct()
  {
    $this->blocks = new \Doctrine\Common\Collections\ArrayCollection();
    $this->children = new \Doctrine\Common\Collections\ArrayCollection();
  }

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
  * @return Page
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
  * Add blocks
  *
  * @param \Brix\CoreBundle\Entity\Block $blocks
  * @return Page
  */
  public function addBlock(\Brix\CoreBundle\Entity\Block $blocks)
  {
    $this->blocks[] = $blocks;

    return $this;
  }

  /**
  * Remove blocks
  *
  * @param \Brix\CoreBundle\Entity\Block $blocks
  */
  public function removeBlock(\Brix\CoreBundle\Entity\Block $blocks)
  {
    $this->blocks->removeElement($blocks);
  }

  /**
  * Get blocks
  *
  * @return \Doctrine\Common\Collections\Collection
  */
  public function getBlocks()
  {
    return $this->blocks;
  }

  /**
  * Set type
  *
  * @param \Brix\CoreBundle\Entity\PageType $type
  * @return Page
  */
  public function setType(\Brix\CoreBundle\Entity\PageType $type = null)
  {
    $this->type = $type;

    return $this;
  }

  /**
  * Get type
  *
  * @return \Brix\CoreBundle\Entity\PageType
  */
  public function getType()
  {
    return $this->type;
  }

  /**
  * Set url
  *
  * @param string $url
  * @return Page
  */
  public function setUrl($url)
  {
    $this->url = $url;

    return $this;
  }

  /**
  * Get url
  *
  * @return string
  */
  public function getUrl()
  {
    return $this->url;
  }

  /**
  * Set entity
  *
  * @param integer $entity
  * @return Page
  */
  public function setEntity($entity)
  {
    $this->entity = $entity;

    return $this;
  }

  /**
  * Get entity
  *
  * @return integer
  */
  public function getEntity()
  {
    return $this->entity;
  }

  public function getTypeId(){
    return $this->getType()->getId();
  }

  /**
  * Add children
  *
  * @param \Brix\CoreBundle\Entity\Page $children
  * @return Page
  */
  public function addChild(\Brix\CoreBundle\Entity\Page $children)
  {
    $this->children[] = $children;

    return $this;
  }

  /**
  * Remove children
  *
  * @param \Brix\CoreBundle\Entity\Page $children
  */
  public function removeChild(\Brix\CoreBundle\Entity\Page $children)
  {
    $this->children->removeElement($children);
  }

  /**
  * Get children
  *
  * @return \Doctrine\Common\Collections\Collection
  */
  public function getChildren()
  {
    return $this->children;
  }

  /**
  * Set parent
  *
  * @param \Brix\CoreBundle\Entity\Page $parent
  * @return Page
  */
  public function setParent(\Brix\CoreBundle\Entity\Page $parent = null)
  {
    $this->parent = $parent;

    return $this;
  }

  /**
  * Get parent
  *
  * @return \Brix\CoreBundle\Entity\Page
  */
  public function getParent()
  {
    return $this->parent;
  }

  /**
  * Set original
  *
  * @param \Brix\CoreBundle\Entity\Page $original
  * @return Page
  */
  public function setOriginal(\Brix\CoreBundle\Entity\Page $original = null)
  {
    $this->original = $original;

    return $this;
  }

  /**
  * Get original
  *
  * @return \Brix\CoreBundle\Entity\Page
  */
  public function getOriginal()
  {
    return $this->original;
  }

  /**
  * Set language
  *
  * @param \Brix\CoreBundle\Entity\Language $language
  * @return Page
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

  public function __toString(){
    return strval($this->getId());
  }

  /**
  * @JMS\VirtualProperty
  * @JMS\Groups({"list"})
  */
  public function level(){
    if($this->getParent() == null){
      return 0;
    } else {
      $level = 1;
      $parent = $this->getParent();
      while($parent = $parent->getParent()){
        $level++;
      }
      return $level;
    }
  }

    /**
     * Set isHomepage
     *
     * @param boolean $isHomepage
     * @return Page
     */
    public function setIsHomepage($isHomepage)
    {
        $this->isHomepage = $isHomepage;

        return $this;
    }

    /**
     * Get isHomepage
     *
     * @return boolean
     */
    public function getIsHomepage()
    {
        return $this->isHomepage;
    }

    public function getLanguageArray(){
        if($this->getLanguage())return $this->getLanguage()->toArray();
        return null;

    }
}
