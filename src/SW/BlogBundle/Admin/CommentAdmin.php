<?php

namespace SW\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

use SW\BlogBundle\Entity\Comment;

class CommentAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user', null, array(
                'attr' => array('disabled' => true)
            ))
            ->add('comment', null, array(
                'attr' => array('disabled' => true)
            ))
            ->add('blog','sonata_type_model_hidden')
            ->add('created', 'datetime', array(
                'attr'    => array('disabled' => true),
                'widget'  => 'single_text',
                'attr'    => array('readonly' => true)
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('comment')
            ->add('blog','sonata_type_model_hidden')            
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('user')
            ->add('comment')
            ->add('blog','sonata_type_model_hidden')
            ->add('created')
        ;
    }

}