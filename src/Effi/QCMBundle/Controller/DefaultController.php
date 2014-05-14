<?php

namespace Effi\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$name = 'world';
        return $this->render('EffiQCMBundle:Default:index.html.twig', array('name' => $name));
    }
}
