<?php

namespace SW\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

use SW\UserBundle\Entity\User;

class UserAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', null, array(
                'attr' => array('disabled' => true)
            ))
            ->add('lastname', null, array(
                'attr' => array('disabled' => true)
            ))
            ->add('firstname', null, array(
                'attr' => array('disabled' => true)
            ))
            ->add('email', null, array(
                'attr' => array('disabled' => true)
            ))
            ->add('ban')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('lastname')
            ->add('firstname')   
            ->add('email')  
            ->add('ban')       
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('ban')
        ;
    }

}