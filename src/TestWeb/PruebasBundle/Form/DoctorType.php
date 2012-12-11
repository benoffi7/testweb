<?php

namespace TestWeb\PruebasBundle\Form;

use TestWeb\PruebasBundle\Form\DataTransformer\NombreToEspecialidadTransformer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {    	
    	$entityManager = $options['em'];
    	$transformer = new NombreToEspecialidadTransformer($entityManager);
    	
    	$builder
            ->add('apellido')
            ->add('nombre')
            ->add('dni')
            ->add('fechaNacimiento')
            ->add($builder->create('especialidad', 'text')->addModelTransformer($transformer))
            //->add('especialidad','text',array('attr'=>array('title'=>'Ingrese una nueva especialidad o elija entre las disponibles')))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'TestWeb\PruebasBundle\Entity\Doctor' ));
        
        $resolver->setRequired(array('em',));
        
        $resolver->setAllowedTypes(array('em' => 'Doctrine\Common\Persistence\ObjectManager',  ));
    }

    public function getName()
    {
        return 'testweb_pruebasbundle_doctortype';
    }
}
