<?php

namespace Effi\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Theme
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Theme
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
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="QCM", mappedBy="theme")
     */
    protected $qcms;

    public function __construct()
    {
        $this->qcms = new ArrayCollection();
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
     * Set label
     *
     * @param string $label
     * @return Theme
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Add qcms
     *
     * @param \Effi\QCMBundle\Entity\QCM $qcms
     * @return Theme
     */
    public function addQcm(\Effi\QCMBundle\Entity\QCM $qcms)
    {
        $this->qcms[] = $qcms;

        return $this;
    }

    /**
     * Remove qcms
     *
     * @param \Effi\QCMBundle\Entity\QCM $qcms
     */
    public function removeQcm(\Effi\QCMBundle\Entity\QCM $qcms)
    {
        $this->qcms->removeElement($qcms);
    }

    /**
     * Get qcms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQcms()
    {
        return $this->qcms;
    }
}
