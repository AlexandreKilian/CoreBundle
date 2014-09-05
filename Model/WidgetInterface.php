<?php

namespace Brix\CoreBundle\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\MappedSuperclass
 */
interface WidgetInterface
{


    public function getForm();

}
