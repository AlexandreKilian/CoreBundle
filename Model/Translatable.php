<?php

namespace Brix\CoreBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Brix\CoreBundle\Entity\Block;
use JMS\Serializer\Annotation as JMS;



abstract class Translatable
{

    abstract private $original;
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

}
