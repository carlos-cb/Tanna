<?php

namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productNameEs', null, array('label' => 'Nombre de Producto ES'))
            ->add('productNameEn', null, array('label' => 'Nombre de Producto EN'))
            ->add('category', null, array(
                'label' => 'Categoría',
                'class' => 'ShopBundle:Category',
                'property' => 'categoryNameEs',
            ))
            ->add('foto', FileType::class, array(
                'data_class' => null,
                'required' => false,
            ))
            ->add('price', null, array('label' => 'Precio'))
            ->add('code', null, array('label' => 'Código'))
            ->add('description', null, array('label' => 'Descripción'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\Product'
        ));
    }
}
