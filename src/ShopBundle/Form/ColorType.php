<?php

namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ColorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('colorFoto', FileType::class, array(
                'label' => 'Foto de Color Principal',
                'data_class' => null,
                'required' => false,
            ))
            ->add('colorNameEs', null, array('label' => 'Nombre de Color ES'))
            ->add('colorNameEn', null, array('label' => 'Nombre de Color EN'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\Color'
        ));
    }
}
