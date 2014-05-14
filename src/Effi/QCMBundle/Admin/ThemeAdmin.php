<?php
// src/Effi/QCMBundle/Admin/ThemeAdmin.php

namespace Effi\QCMBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ThemeAdmin extends Admin
{
    // FORMULAIRE EDITION AJOUT
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('label', 'text')
        ;
    }

    // FORMULAIRE FILTRE
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('label')
            ->add('qcms')
        ;
    }

    // FORMULAIRE LISTE
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('label')
            ->add('qcms')
        ;
    }
}