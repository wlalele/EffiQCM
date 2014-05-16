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
     * @ORM\ManyToOne(targetEntity="Theme", inversedBy="qcms")
     * @ORM\JoinColumn(name="theme_id", referencedColumnName="id")
     */
    protected $theme;

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
     * Set theme
     *
     * @param \Effi\QCMBundle\Entity\Theme $theme
     * @return QCM
     */
    public function setTheme(\Effi\QCMBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Effi\QCMBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
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
                if($answer->getAnswer()->getId() == $answer->getAnswer()->getQuestion()->getValidAnswer()->getId()) {
                    $note += 1;
                }
                $count++;
            }
        }
        if($count == count($this->getQuestions())) {
            return $note . '/' . $count . ' (' . round($note/$count)*100 . '%)';
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
}
