<?php

namespace Effi\QCMBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class NotationAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('qcm', 'entity', array('class' => 'Effi\QCMBundle\Entity\QCM'))
            ->add('user', 'entity', array('class' => 'Effi\UserBundle\Entity\User'))
            ->add('notation', 'text')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('qcm')
            ->add('user')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('qcm')
            ->addIdentifier('user')
            ->addIdentifier('notation')
        ;
    }
}