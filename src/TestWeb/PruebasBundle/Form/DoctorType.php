<?php

namespace TestWeb\PruebasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('apellido')
            ->add('nombre')
            ->add('dni')
            ->add('fechaNacimiento')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TestWeb\PruebasBundle\Entity\Doctor'
        ));
    }

    public function getName()
    {
        return 'testweb_pruebasbundle_doctortype';
    }
}
