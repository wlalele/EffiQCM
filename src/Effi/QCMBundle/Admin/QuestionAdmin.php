<?php
// src/Effi/QCMBundle/Admin/QuestionAdmin.php

namespace Effi\QCMBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class QuestionAdmin extends Admin
{
    // FORMULAIRE EDITION AJOUT
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('author', 'entity', array('class' => 'Effi\UserBundle\Entity\User'))
            ->add('label', 'text')
            ->add('qcm', 'entity', array('class' => 'Effi\QCMBundle\Entity\QCM', 'property' => 'label'))
        ;
    }

    // FORMULAIRE FILTRE
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('label')
            ->add('author')
            ->add('answers')
        ;
    }

    // FORMULAIRE LISTE
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('author')
            ->addIdentifier('label')
            ->addIdentifier('qcm', null, array('associated_tostring' => 'getLabel'))
            ->addIdentifier('answers', null, array('associated_tostring' => 'getLabel'))
        ;
    }
}