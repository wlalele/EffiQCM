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
            ->add('published', 'checkbox', array('required' => false))
            ->add('publishedResult', 'checkbox', array('required' => false))
            ->add('limitDate', 'datetime')
        ;
    }

    // FORMULAIRE FILTRE
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('label')
        ;
    }

    // FORMULAIRE LISTE
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('label')
            ->addIdentifier('published')
            ->addIdentifier('publishedResult')
            ->addIdentifier('limitDate')
        ;
    }
}