<?php

namespace Effi\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * QCM
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class QCM
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
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $published;

    /**
     * @var date
     *
     * @ORM\Column(name="limit_date", type="date")
     */
    private $limitDate;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="qcm")
     */
    protected $questions = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
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
     * @return QCM
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
     * Add questions
     *
     * @param \Effi\QCMBundle\Entity\Question $questions
     * @return QCM
     */
    public function addQuestion(\Effi\QCMBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \Effi\QCMBundle\Entity\Question $questions
     */
    public function removeQuestion(\Effi\QCMBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set questions
     *
     * @param \Effi\QCMBundle\Entity\Question $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    /**
     * @param \Effi\UserBundle\Entity\User $user
     * @return int
     */
    public function getNote(\Effi\UserBundle\Entity\User $user) {
        $count = 0;
        $note = 0;
        foreach($user->getAnswers() as $answer) {
            if($answer->getAnswer()->getQuestion()->getQCM()->getId() == $this->id) {
                if($answer->getAnswer()->getIsValid()) {
                    $note += 1;
                }
                $count++;
            }
        }
        if($count == 0) return '0/0';
        if($count == count($this->getQuestions())) {
            return $note . '/' . $count . ' (' . round(($note/$count)*100) . '%)';
        } else {
            return null;
        }
    }

    /**
     * @param \Effi\UserBundle\Entity\User $user
     * @return mixed
     */
    public function getNextQuestion(\Effi\UserBundle\Entity\User $user) {
        foreach($this->getQuestions() as $question) {
            $found = false;
            foreach($user->getAnswers() as $choice) {
                if($choice->getAnswer()->getQuestion() == $question) {
                    $found = true;
                    break;
                }
            }
            if(!$found) {
                return $question;
            }
        }
        return false;
    }

    /**
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param boolean $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return date
     */
    public function getLimitDate()
    {
        return $this->limitDate;
    }

    /**
     * @param date $limitDate
     */
    public function setLimitDate($limitDate)
    {
        $this->limitDate = $limitDate;
    }
}
