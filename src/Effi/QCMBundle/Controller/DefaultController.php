<?php

namespace Effi\QCMBundle\Controller;

use Effi\QCMBundle\Form\Type\QuestionType;
use Proxies\__CG__\Effi\QCMBundle\Entity\Choice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $qcms = $this->getDoctrine()
            ->getRepository('EffiQCMBundle:QCM')
            ->findAll();

        return $this->render('EffiQCMBundle:Default:index.html.twig', array('qcms' => $qcms));
    }

    public function questionAction(Request $request, $questionId)
    {
        $question = $this->getDoctrine()
            ->getRepository('EffiQCMBundle:Question')
            ->find($questionId);

        try {
            $anwser = $this->getDoctrine()
                ->getRepository('EffiQCMBundle:Choice')
                ->createQueryBuilder('c')
                ->join('c.answer', 'a')
                ->where('c.user = :user')
                ->andWhere('a.question = :question')
                ->setParameter('user', $this->getUser())
                ->setParameter('question', $question)
                ->getQuery()
                ->getSingleResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $anwser = new Choice();
        }

        $form = $this->createForm(new QuestionType($question), $anwser);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $anwser->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($anwser);
            $em->flush();
            $next = $question->getQCM()->getNextQuestion($this->getUser());
            if($next) {
                return $this->redirect($this->generateUrl('effi_qcm_question', array('questionId' => $next->getId())));
            } else {
                return $this->redirect($this->generateUrl('effi_qcm_homepage'));
            }
        }

        return $this->render('EffiQCMBundle:Default:question.html.twig', array('question' => $question, 'form' => $form->createView()));
    }
}
