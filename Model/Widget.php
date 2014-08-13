<?php

namespace Brix\CoreBundle\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\MappedSuperclass
 */
class Widget implements WidgetInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

  
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
     * @param \Brix\CmsBundle\Entity\Block $block
     * @return Widget
     */
    public function setWidget(\Brix\CmsBundle\Entity\Widget $block = null)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return \Brix\CmsBundle\Entity\Block
     */
    public function getWidget()
    {
        return $this->block;
    }
}
