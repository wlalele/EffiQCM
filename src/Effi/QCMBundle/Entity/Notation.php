<?php

namespace Effi\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Notation
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
     * @ORM\Column(type="string", length=10)
     */
    private $notation;

    /**
     * @ORM\ManyToOne(targetEntity="QCM", inversedBy="notations")
     * @ORM\JoinColumn(name="qcm_id", referencedColumnName="id")
     */
    protected $qcm;

    /**
     * @ORM\ManyToOne(targetEntity="Effi\UserBundle\Entity\User", inversedBy="notations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNotation()
    {
        return $this->notation;
    }

    /**
     * @param string $notation
     */
    public function setNotation($notation)
    {
        $this->notation = $notation;
    }

    /**
     * Set qcm
     *
     * @param \Effi\QCMBundle\Entity\QCM $qcm
     * @return Notation
     */
    public function setQcm(\Effi\QCMBundle\Entity\QCM $qcm = null)
    {
        $this->qcm = $qcm;

        return $this;
    }

    /**
     * Get qcm
     *
     * @return \Effi\QCMBundle\Entity\QCM 
     */
    public function getQcm()
    {
        return $this->qcm;
    }

    /**
     * Set user
     *
     * @param \Effi\UserBundle\Entity\User $user
     * @return Notation
     */
    public function setUser(\Effi\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Effi\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
