<?php

namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderInfoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orderDate', 'datetime')
            ->add('goodsFee')
            ->add('shipFee')
            ->add('totalPrice')
            ->add('payType')
            ->add('receiverName')
            ->add('receiverFamilyName')
            ->add('receiverPhone')
            ->add('receiverAdress')
            ->add('receiverCity')
            ->add('receiverProvince')
            ->add('receiverEmail')
            ->add('receiverPostcode')
            ->add('isConfirmed')
            ->add('isSended')
            ->add('isOver')
            ->add('state')
            ->add('envio')
            ->add('shipmode')
            ->add('user')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\OrderInfo'
        ));
    }
}
