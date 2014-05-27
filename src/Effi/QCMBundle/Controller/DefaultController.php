<?php

namespace Effi\QCMBundle\Controller;

use Effi\QCMBundle\Entity\Notation;
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
            ->createQueryBuilder('q')
            ->where('q.published = 1')
            ->getQuery()
            ->getResult();

        return $this->render('EffiQCMBundle:Default:index.html.twig', array('qcms' => $qcms));
    }

    public function questionAction(Request $request, $questionId)
    {
        try {
            $question = $this->getDoctrine()
                ->getRepository('EffiQCMBundle:Question')
                ->createQueryBuilder('q')
                ->join('q.qcm', 'qcm')
                ->where('q.id = :questionId')
                ->andWhere('qcm.published = 1')
                ->setParameter('questionId', $questionId)
                ->getQuery()
                ->getSingleResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            throw $this->createNotFoundException(
                'Aucune question trouvée pour cet id'
            );
        }

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
                $notation = new Notation();
                $notation->setNotation($question->getQCM()->getNote($this->getUser()));
                $notation->setQcm($question->getQCM());
                $notation->setUser($this->getUser());
                $em->persist($notation);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'QCM "' . $question->getQCM()->getLabel() . '" complété!'
                );
                return $this->redirect($this->generateUrl('effi_qcm_homepage'));
            }
        }

        return $this->render('EffiQCMBundle:Default:question.html.twig', array('question' => $question, 'form' => $form->createView()));
    }

    public function myResultsAction()
    {
        $notations = $this->getDoctrine()
            ->getRepository('EffiQCMBundle:Notation')
            ->createQueryBuilder('n')
            ->join('n.qcm', 'q')
            ->where('n.user = :user')
            ->setParameter('user', $this->getUser())
            ->getQuery()
            ->getResult();

        return $this->render('EffiQCMBundle:Default:myResults.html.twig', array('notations' => $notations));
    }

    public function resultsAction()
    {
        $qcms = $this->getDoctrine()
            ->getRepository('EffiQCMBundle:QCM')
            ->createQueryBuilder('q')
            ->where('q.publishedResult = 1')
            ->getQuery()
            ->getResult();

        return $this->render('EffiQCMBundle:Default:results.html.twig', array('qcms' => $qcms));
    }
}
