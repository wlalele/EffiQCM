<?php

namespace Effi\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
