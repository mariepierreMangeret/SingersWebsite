<?php

namespace SW\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use SW\PlatformBundle\Entity\Video;

class VideoAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Videos', array('class' => 'col-md-9'))
                ->add('name', 'text')
                ->add('link', 'text')
                ->add('image', 'sonata_media_type', array(
                    'provider'   => 'sonata.media.provider.image',
                    'context'    => 'video',
                    'required'   => false,
                    'data_class' => 'Application\Sonata\MediaBundle\Entity\Media',
                    'label'      => 'Image',
                ))
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('custom', 'string', array('template' => 'SWPlatformBundle::list_imagefield_custom.html.twig', 'label' => 'Image'))
            ->addIdentifier('name')
            ->add('id')
        ;
    }
}