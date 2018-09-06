<?php

namespace SW\PlatformBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use SW\PlatformBundle\Entity\Header;

class HeaderAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Header', array('class' => 'col-md-9'))
                ->add('titleOne', 'text')
                ->add('titleTwo', 'text')
                ->add('image', 'sonata_media_type', array(
                    'provider'   => 'sonata.media.provider.image',
                    'context'    => 'header',
                    'required'   => false,
                    'data_class' => 'Application\Sonata\MediaBundle\Entity\Media',
                    'label'      => 'Image Single',
                ))
                ->add('video', 'sonata_media_type', array(
                    'provider'   => 'sonata.media.provider.file',
                    'context'    => 'header',
                    'required'   => false,
                    'data_class' => 'Application\Sonata\MediaBundle\Entity\Media',
                    'label'      => 'File',
                ))
                ->add('imageBann', 'sonata_media_type', array(
                    'provider'   => 'sonata.media.provider.image',
                    'context'    => 'header',
                    'required'   => false,
                    'data_class' => 'Application\Sonata\MediaBundle\Entity\Media',
                    'label'      => 'Image Banniere',
                ))
                ->add('imageAdd', 'sonata_media_type', array(
                    'provider'   => 'sonata.media.provider.image',
                    'context'    => 'header',
                    'required'   => false,
                    'data_class' => 'Application\Sonata\MediaBundle\Entity\Media',
                    'label'      => 'Image Publicite',
                ))
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('titleOne')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('titleOne')
            ->add('id')
        ;
    }
}