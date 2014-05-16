<?php
namespace Effi\QCMBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class QuestionType extends AbstractType
{
    public function __construct($question) {
        $this->question = $question;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('answer', 'entity', array(
            'class' => 'EffiQCMBundle:Answer',
            'property' => 'label',
            'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->where('a.question = :question')
                        ->setParameter('question', $this->question);
                },
            'expanded' => true
        ));
    }

    public function getName()
    {
        return 'question';
    }
}