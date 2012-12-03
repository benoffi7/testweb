<?php

namespace TestWeb\PruebasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TurnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaTurno',null,array("label" => "Fecha del turno"))
            ->add('confirmado',null,array('required'=>false))
            ->add('realizado',null,array('required'=>false))
            ->add('paciente')
            ->add('doctor')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TestWeb\PruebasBundle\Entity\Turno'
        ));
    }

    public function getName()
    {
        return 'testweb_pruebasbundle_turnotype';
    }
}
