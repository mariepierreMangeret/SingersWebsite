<?php

namespace SW\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

use SW\PlatformBundle\Entity\Disc;

class DiscAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Information Generale')
                ->with('Nouveau disque', array('class' => 'col-md-9'))
                    ->add('title', 'text')
                    ->add('information', 'textarea')
                    ->add('urlAmazon', 'text')
                    ->add('urlItunes', 'text')
                    ->add('urlShop', 'text')
                    ->add('imageMin', 'sonata_media_type', array(
                    'provider'   => 'sonata.media.provider.image',
                    'context'    => 'disc',
                    'required'   => false,
                    'data_class' => 'Application\Sonata\MediaBundle\Entity\Media',
                    'label'      => 'Image Min',
                    ))
                    ->add('image', 'sonata_media_type', array(
                    'provider'   => 'sonata.media.provider.image',
                    'context'    => 'disc',
                    'required'   => false,
                    'data_class' => 'Application\Sonata\MediaBundle\Entity\Media',
                    'label'      => 'Image',
                    ))
                ->end()
                ->with('Categorie', array('class' => 'col-md-9'))
                    ->add('typedisc', 'entity', array(
                        'class'        => 'SW\PlatformBundle\Entity\Typedisc',
                        'choice_label' => 'title',
                    ))
                ->end()
            ->end()

            ->tab('Chansons')
                ->with('Choix des chansons')
                    ->add('songs','sonata_type_collection', array(), array(
                            'edit'   => 'inline',
                            'inline' => 'table'
                    ))
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')        
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('custom', 'string', array('template' => 'SWPlatformBundle::list_imagefield_custom.html.twig', 'label' => 'Image'))
            ->addIdentifier('title')          
        ;
    }
}