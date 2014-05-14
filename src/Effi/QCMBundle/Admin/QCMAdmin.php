<?php
// src/Effi/QCMBundle/Admin/QCMAdmin.php

namespace Effi\QCMBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class QCMAdmin extends Admin
{
    // FORMULAIRE EDITION AJOUT
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('label', 'text')
            ->add('theme', 'entity', array('class' => 'Effi\QCMBundle\Entity\Theme'))
            ->add('question', 'entity', array('class' => 'Effi\QCMBundle\Entity\Question'))
        ;
    }

    // FORMULAIRE FILTRE
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('label')
            ->add('theme')
            ->add('question')
        ;
    }

    // FORMULAIRE LISTE
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('label')
            ->add('theme')
            ->add('question')
        ;
    }
}