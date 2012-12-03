<?php

namespace TestWeb\PruebasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PacienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Apellido')
            ->add('Nombre')
            ->add('Dni')
            ->add('FechaNacimiento')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TestWeb\PruebasBundle\Entity\Paciente'
        ));
    }

    public function getName()
    {
        return 'testweb_pruebasbundle_pacientetype';
    }
}
