<?php

namespace SW\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

use SW\BlogBundle\Entity\Blog;

class BlogPostAdmin extends Admin
{
    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'created',
    ];
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Article')
                ->with('Content', array('class' => 'col-md-9'))
                    ->add('title', 'text')
                    ->add('blog', null, array(
                        'required' => true, 
                        'attr'     => array('style'=>'height:300px;')
                    ))
                ->end()

                ->with('Date de création', array('class' => 'col-md-9'))
                    ->add('draft')
                    ->add('created', 'datetime', array(
                        'required'=> false, 
                        'widget'  => 'single_text',
                        'attr'    => array('readonly' => true)
                    ))
                ->end()
            ->end()

            ->tab('Commentaires')
                ->with('Commentaires')
                    ->add('comments', 'sonata_type_collection', array(),array(
                        'edit'   => 'inline',
                        'inline' => 'table'
                    ))
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('draft')
            ->add('created')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('draft')
            ->add('created')
        ;
    }
}