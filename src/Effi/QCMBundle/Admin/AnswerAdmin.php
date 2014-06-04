<?php
// src/Effi/QCMBundle/Admin/AnswerAdmin.php

namespace Effi\QCMBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AnswerAdmin extends Admin
{
    // FORMULAIRE EDITION AJOUT
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('author', 'entity', array('class' => 'Effi\UserBundle\Entity\User'))
            ->add('label', 'text')
            ->add('isValid', 'checkbox', array('required' => false))
            ->add('question', 'entity', array('class' => 'Effi\QCMBundle\Entity\Question', 'property' => 'label'))
        ;
    }

    // FORMULAIRE FILTRE
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('label')
            ->add('author')
            ->add('isValid')
            ->add('question')
        ;
    }

    // FORMULAIRE LISTE
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('author')
            ->addIdentifier('label')
            ->addIdentifier('isValid')
            ->add('question', null, array('associated_tostring' => 'getLabel'))
        ;
    }
}