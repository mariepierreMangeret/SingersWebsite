<?php

namespace SW\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

use SW\PlatformBundle\Entity\News;

class NewsAdmin extends Admin
{
    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'date',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Nouveautés', array('class' => 'col-md-9'))
                ->add('subject', 'text')
                ->add('message', 'textarea', array(
                    'required'=> true, 
                    'attr'    => array('style'=>'height:300px;')
                ))
            ->end()
            ->with('Date de création', array('class' => 'col-md-9'))
                ->add('date', 'datetime', array(
                    'required'=> false, 
                    'widget'  => 'single_text',
                    'attr'    => array('readonly' => true)
                ))
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('subject')
            ->add('message')
         
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('subject')
            ->add('date')
        ;
    }

    public function create($object) 
    {
        $object->setDate(new \DateTime());
        return parent::create($object);
    }
}