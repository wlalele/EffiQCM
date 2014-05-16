<?php

namespace Effi\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $qcms = $this->getDoctrine()
            ->getRepository('EffiQCMBundle:QCM')
            ->findAll();

        return $this->render('EffiQCMBundle:Default:index.html.twig', array('qcms' => $qcms));
    }
}
