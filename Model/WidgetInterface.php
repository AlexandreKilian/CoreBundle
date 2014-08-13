<?php

namespace Brix\CoreBundle\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\MappedSuperclass
 */
interface WidgetInterface
{


    public function setWidget(\Brix\CmsBundle\Entity\Widget $block = null);

    public function getWidget();

}
