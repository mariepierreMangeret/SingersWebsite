<?php

namespace SW\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use FOS\UserBundle\Form\Type\RegistrationType;

class ProfileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('adress')
            ->add('postalcode')
            ->add('city')
            ->add('country')
            ->add('phone')
            ->add('image', 'sonata_media_type', array(
                'provider'   => 'sonata.media.provider.image',
                'context'    => 'profil',
                'required'   => false,
                'data_class' => 'Application\Sonata\MediaBundle\Entity\Media',
                'label'      => 'Image',
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SW\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sw_platform_profile';
    }
}

