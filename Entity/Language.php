<?php

namespace Brix\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Language
*
* @ORM\Table(name="brix_core_language")
* @ORM\Entity
*/
class Language
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
    * @ORM\Column(name="name", type="string", length=255)
    */
    private $name;

    /**
    * @var string
    *
    * @ORM\Column(name="locale", type="string", length=5)
    */
    private $locale;


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
    * @return Language
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
    * Set locale
    *
    * @param string $locale
    * @return Language
    */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
    * Get locale
    *
    * @return string
    */
    public function getLocale()
    {
        return $this->locale;
    }

    public function toArray(){
        return Array(
        'id' => $this->getId(),
        'name' => $this->getName(),
        'locale' => $this->getLocale()
    );
}

public function __toString(){
    return strval($this->getId());
}
}
