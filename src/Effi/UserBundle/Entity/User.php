<?php
// src/Effi/UserBundle/Entity/User.php

namespace Effi\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
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

    /**
     * @ORM\OneToMany(targetEntity="Effi\QCMBundle\Entity\Notation", mappedBy="user")
     */
    protected $notations;

    public function __construct()
    {
        parent::__construct();
        $this->answers = new ArrayCollection();
        $this->notations = new ArrayCollection();
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

    /**
     * Add notations
     *
     * @param \Effi\QCMBundle\Entity\Notation $notations
     * @return User
     */
    public function addNotation(\Effi\QCMBundle\Entity\Notation $notations)
    {
        $this->notations[] = $notations;

        return $this;
    }

    /**
     * Remove notations
     *
     * @param \Effi\QCMBundle\Entity\Notation $notations
     */
    public function removeNotation(\Effi\QCMBundle\Entity\Notation $notations)
    {
        $this->notations->removeElement($notations);
    }

    /**
     * Get notations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotations()
    {
        return $this->notations;
    }
}
