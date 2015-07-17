<?php

namespace IM\SysTurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('data')
            //->add('fechaAlta')
            //->add('fechaBaja')
            //->add('fechaModificacion')
            //->add('cliente')
            ->add('tipoContacto')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IM\SysTurBundle\Entity\Contacto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'im_systurbundle_contacto';
    }
}
