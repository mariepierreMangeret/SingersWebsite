<?php

namespace SW\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

use SW\PlatformBundle\Entity\Experience;

class ExperienceAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Nouvelle Experience', array('class' => 'col-md-9'))
                ->add('entitled', 'textarea')
                ->add('date', 'datetime', array(
                    'required'=> true
                ))

            ->end()
            ->with('Categorie', array('class' => 'col-md-9'))
                ->add('section', 'entity', array(
                    'class'        => 'SW\PlatformBundle\Entity\Section',
                    'choice_label' => 'title',
                ))
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('entitled')
            ->add('date')
        
         
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('entitled')
            
        ;
    }
}