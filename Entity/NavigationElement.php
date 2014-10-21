<?php

namespace Brix\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NavigationElement
 *
 * @ORM\Table(name="brix_core_navigation_element")
 * @ORM\Entity
 */
class NavigationElement
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Navigation", inversedBy="elements")
     * @ORM\JoinColumn(name="navigation_id")
     */
    private $navigation;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="NavigationElement", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", nullable=true)
     */
    private $parent;

    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="NavigationElement", mappedBy="parent")
     */
    private $children;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Page")
     * @ORM\JoinColumn(name="page_id", nullable=true)
     */
    private $page;

    /**
     * @var integer
     *
     * @ORM\Column(name="display_name", type="string",length=255, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="url", type="string",length=255, nullable=true)
     */
    private $url;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set navigation
     *
     * @param integer $navigation
     * @return NavigationElement
     */
    public function setNavigation($navigation)
    {
        $this->navigation = $navigation;

        return $this;
    }

    /**
     * Get navigation
     *
     * @return integer
     */
    public function getNavigation()
    {
        return $this->navigation;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     * @return NavigationElement
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return NavigationElement
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set page
     *
     * @param integer $page
     * @return NavigationElement
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return integer
     */
    public function getPage()
    {
        return $this->page;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set names
     *
     * @param string $names
     * @return NavigationElement
     */
    public function setNames($names)
    {
        $this->names = $names;

        return $this;
    }

    /**
     * Get names
     *
     * @return string
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return NavigationElement
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
     * Add children
     *
     * @param \Brix\CoreBundle\Entity\NavigationElement $children
     * @return NavigationElement
     */
    public function addChild(\Brix\CoreBundle\Entity\NavigationElement $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Brix\CoreBundle\Entity\NavigationElement $children
     */
    public function removeChild(\Brix\CoreBundle\Entity\NavigationElement $children)
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
     * Set name
     *
     * @param string $name
     * @return NavigationElement
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

    public function getPath(){
        if($this->getPage()){
            return $this->getPage()->getUrl();
        } else{
            return $this->getUrl();
        }
    }

    public function getDisplayname(){
        if($this->getPage()){
            if($this->getName()){
                return $this->getName();
            } else{
                return $this->getPage()->getName();
            }
        } else{
            return $this->getName();
        }
    }

    /**
     * Set classes
     *
     * @param string $classes
     * @return NavigationElement
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
     * @return NavigationElement
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
}
