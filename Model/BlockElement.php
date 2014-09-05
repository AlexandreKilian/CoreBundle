<?php

namespace Brix\CoreBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Brix\CoreBundle\Entity\Block;
use JMS\Serializer\Annotation as JMS;



abstract class BlockElement
{


    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Brix\CoreBundle\Entity\Block", inversedBy="widgets")
     * @ORM\JoinColumn(name="element_block", nullable=true)
     * @JMS\Exclude
     */
    protected $block;

    /**
     * @var string
     *
     * @ORM\Column(name="order",type="integer", nullable=true)
     */
    protected $order;


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
     * Set order
     *
     * @param integer
     * @return BlockElement
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

}
