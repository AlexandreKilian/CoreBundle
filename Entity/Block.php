<?php

namespace Brix\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;


use Brix\CoreBundle\Model\BlockElement;

/**
* Block
*
* @ORM\Table(name="brix_core_block")
* @ORM\Entity
*/

class Block extends BlockElement

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
  * @ORM\ManyToOne(targetEntity="Page", inversedBy="blocks")
  * @ORM\JoinColumn(name="block_page")
  * @JMS\Exclude
  */
  private $page;

  /**
  * @var string
  *
  * @ORM\Column(name="name", type="string", length=255, nullable=true)
  */
  private $name;

  /**
  * @var string
  *
  * @ORM\OneToMany(targetEntity="Widget", mappedBy="block")
  * @JMS\Exclude
  */
  private $widgets;

  /**
  * @var string
  *
  * @ORM\OneToMany(targetEntity="Block", mappedBy="block")
  * @JMS\Exclude
  */
  private $subblocks;

  /**
  * @var boolean
  *
  * @ORM\Column(name="repeater",type="boolean")
  *
  */
  private $repeater = false;

  /**
  * @var string
  *
  * @ORM\ManyToOne(targetEntity="WidgetType")
  * @ORM\JoinColumn(name="repeater_widget", nullable=true)
  */
  private $repeaterWidget;

  /**
  *
  * @ORM\Column(name="repeater_limit",type="integer", nullable=true)
  */
  private $repeaterLimit;

  /**
  * Constructor
  */
  public function __construct()
  {
    $this->widgets = new \Doctrine\Common\Collections\ArrayCollection();
    $this->subblocks = new \Doctrine\Common\Collections\ArrayCollection();
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
  * @return Block
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
  * Set repeater
  *
  * @param boolean $repeater
  * @return Block
  */
  public function setRepeater($repeater)
  {
    $this->repeater = $repeater;

    return $this;
  }

  /**
  * Get repeater
  *
  * @return boolean
  */
  public function getRepeater()
  {
    return $this->repeater;
  }

  /**
  * Set repeaterLimit
  *
  * @param integer $repeaterLimit
  * @return Block
  */
  public function setRepeaterLimit($repeaterLimit)
  {
    $this->repeaterLimit = $repeaterLimit;

    return $this;
  }

  /**
  * Get repeaterLimit
  *
  * @return integer
  */
  public function getRepeaterLimit()
  {
    return $this->repeaterLimit;
  }

  /**
  * Set order
  *
  * @param integer $order
  * @return Block
  */
  public function setOrder($order)
  {
    $this->order = $order;

    return $this;
  }

  /**
  * Get order
  *
  * @return integer
  */
  public function getOrder()
  {
    return $this->order;
  }

  /**
  * Set page
  *
  * @param \Brix\CoreBundle\Entity\Page $page
  * @return Block
  */
  public function setPage(\Brix\CoreBundle\Entity\Page $page = null)
  {
    $this->page = $page;

    return $this;
  }

  /**
  * Get page
  *
  * @return \Brix\CoreBundle\Entity\Page
  */
  public function getPage()
  {
    return $this->page;
  }

  /**
  * Add widgets
  *
  * @param \Brix\CoreBundle\Entity\Widget $widgets
  * @return Block
  */
  public function addWidget(\Brix\CoreBundle\Entity\Widget $widgets)
  {
    $this->widgets[] = $widgets;

    return $this;
  }

  /**
  * Remove widgets
  *
  * @param \Brix\CoreBundle\Entity\Widget $widgets
  */
  public function removeWidget(\Brix\CoreBundle\Entity\Widget $widgets)
  {
    $this->widgets->removeElement($widgets);
  }

  /**
  * Get widgets
  *
  * @return \Doctrine\Common\Collections\Collection
  */
  public function getWidgets()
  {
    return $this->widgets;
  }

  /**
  * Add subblocks
  *
  * @param \Brix\CoreBundle\Entity\Block $subblocks
  * @return Block
  */
  public function addSubblock(\Brix\CoreBundle\Entity\Block $subblocks)
  {
    $this->subblocks[] = $subblocks;

    return $this;
  }

  /**
  * Remove subblocks
  *
  * @param \Brix\CoreBundle\Entity\Block $subblocks
  */
  public function removeSubblock(\Brix\CoreBundle\Entity\Block $subblocks)
  {
    $this->subblocks->removeElement($subblocks);
  }

  /**
  * Get subblocks
  *
  * @return \Doctrine\Common\Collections\Collection
  */
  public function getSubblocks()
  {
    return $this->subblocks;
  }

  /**
  * Set repeaterWidget
  *
  * @param \Brix\CoreBundle\Entity\WidgetType $repeaterWidget
  * @return Block
  */
  public function setRepeaterWidget(\Brix\CoreBundle\Entity\WidgetType $repeaterWidget = null)
  {
    $this->repeaterWidget = $repeaterWidget;

    return $this;
  }

  /**
  * Get repeaterWidget
  *
  * @return \Brix\CoreBundle\Entity\WidgetType
  */
  public function getRepeaterWidget()
  {
    return $this->repeaterWidget;
  }

  /**
  * @JMS\VirtualProperty
  * @JMS\SerializedName("children")
  */
  public function getChildren(){
    $children = array_merge($this->widgets->toArray(),$this->subblocks->toArray());
    usort($children,array('Brix\CoreBundle\Entity\Block','compare_children'));
    return $children;
  }


  public function getElementType(){
    return "block";
  }

  static function compare_children(BlockElement $a,BlockElement $b){
    if($a->getOrder() == $b->getOrder()) return 0;
    return ($a->getOrder() > $b->getOrder()) ? 1:-1;
  }


}
