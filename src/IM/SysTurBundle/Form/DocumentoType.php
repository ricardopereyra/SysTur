<?php

namespace IM\SysTurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('fechaEmision')
            ->add('fechaVencimiento')
            ->add('descripcion')
            ->add('imagen')
            //->add('fechaAlta')
            //->add('fechaBaja')
            //->add('fechaModificacion')
            ->add('cliente', 'entity', array(
                'class' => 'IMSysTurBundle:Cliente',
                ))
            ->add('tipoDocumento')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IM\SysTurBundle\Entity\Documento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'im_systurbundle_documento';
    }
}
