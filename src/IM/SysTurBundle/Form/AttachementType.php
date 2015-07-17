<?php

namespace IM\SysTurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttachementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tabla')
            ->add('idSource')
            ->add('path')
            ->add('nota')
            ->add('file')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IM\SysTurBundle\Entity\Attachement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'im_systurbundle_attachement';
    }
}
