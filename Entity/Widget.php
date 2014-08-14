<?php

namespace Brix\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Table(name="brix_core_widget")
 * @ORM\Entity
 */
class Widget
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
     * @ORM\ManyToOne(targetEntity="Block", inversedBy="widgets")
     * @ORM\JoinColumn(name="widget_block")
     * @JMS\Exclude
     */
    private $block;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="WidgetType")
     * @ORM\JoinColumn(name="widget_type")
     */
    private $type;

    /**
     * @ORM\Column(name="entity", type="integer", nullable=true)
     */
     private $entity;

     public $data;

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
     * Set block
     *
     * @param \Brix\CoreBundle\Entity\Block $block
     * @return Widget
     */
    public function setBlock(Block $block = null)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return \Brix\CoreBundle\Entity\Block
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set type
     *
     * @param \Brix\CoreBundle\Entity\WidgetType $type
     * @return Widget
     */
    public function setType(\Brix\CoreBundle\Entity\WidgetType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Brix\CoreBundle\Entity\WidgetType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set entity
     *
     * @param integer $entity
     * @return Widget
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

    public function getData(){
      return $this->data;
    }
}
