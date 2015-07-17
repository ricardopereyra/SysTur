<?php

namespace IM\SysTurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('apellido')
            ->add('nombres')
            ->add('cp')
            ->add('localidad')
            ->add('provincia')
            ->add('direccion')
            ->add('fechaNacimiento', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'years' => range(1950,2020),
                ))
            ->add('dni')
            ->add('cuil')
            //->add('fechaAlta')
            //->add('fechaBaja')
            //->add('fechaModificacion')
            ->add('pais')
            ->add('tipoIva')
            ->add('tipoCliente')
            ->add('categoria')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IM\SysTurBundle\Entity\Cliente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'im_systurbundle_cliente';
    }
}
