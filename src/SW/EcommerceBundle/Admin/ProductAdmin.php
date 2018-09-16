<?php
namespace SW\EcommerceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use ShoopiShop\EcommerceBundle\Entity\Product;

 class ProductAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Product')
                ->with('Product')
                    ->add('slug')
                    ->add('name')
                    ->add('description')
                    ->add('shortDescription')
                    ->add('stock')
                    ->add('price')
                    ->add('weight')
                    ->add('enabled')
                ->end()
                ->with('Media')
                    ->add('image', 'sonata_type_model_list', array('required' => false))
                ->end()
        ;
    }
     protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('slug')
            ->add('name')
            ->add('description')
            ->add('shortDescription')
            ->add('stock')
            ->add('price')
            ->add('weight')
            ->add('enabled')
            ->add('updatedAt')
            ->add('createdAt')
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('slug')
            ->add('name')
            ->add('description')
            ->add('shortDescription')
            ->add('stock')
            ->add('price')
            ->add('weight')
            ->add('enabled')
            ->add('updatedAt')
            ->add('createdAt')
        ;
    }
     public function prePersist($product)
    {
        $now = new \Datetime();
        $product->setUpdatedAt($now);
        $product->setCreatedAt($now);
    }
 } 