<?php
// src/Effi/UserBundle/Entity/User.php

namespace Effi\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Effi\QCMBundle\Entity\Choice", mappedBy="user")
     */
    protected $answers;

    public function __construct()
    {
        parent::__construct();
        $this->answers = new ArrayCollection();
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
     * Add answers
     *
     * @param \Effi\QCMBundle\Entity\Choice $answers
     * @return User
     */
    public function addAnswer(\Effi\QCMBundle\Entity\Choice $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \Effi\QCMBundle\Entity\Choice $answers
     */
    public function removeAnswer(\Effi\QCMBundle\Entity\Choice $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}
