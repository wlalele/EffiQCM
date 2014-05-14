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
            ->add('qcm', 'entity', array('class' => 'Effi\QCMBundle\Entity\QCM'))
        ;
    }

    // FORMULAIRE FILTRE
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('label')
            ->add('author')
            ->add('qcm')
            ->add('answers')
        ;
    }

    // FORMULAIRE LISTE
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('author')
            ->add('label')
            ->add('qcm')
            ->add('answers')
        ;
    }
}