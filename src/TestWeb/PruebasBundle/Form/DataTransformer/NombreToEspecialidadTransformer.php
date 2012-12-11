<?php
namespace TestWeb\PruebasBundle\Form\DataTransformer;

use TestWeb\PruebasBundle\Entity\Especialidad;

use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class NombreToEspecialidadTransformer implements DataTransformerInterface
{
	/**
	 * @var ObjectManager
	 */
	private $om;
	
	/**
	 * @param ObjectManager $om
	 */
	public function __construct(ObjectManager $om)
	{
		$this->om = $om;
	}
	
	/**
	 * Transforms an object (issue) to a string (number).
	 *
	 * @param  Especialidad|null $especialidad
	 * @return string
	 */
	public function transform($especialidad)
	{
		if (null === $especialidad) 
		{
			return "";
		}
		
		return $especialidad->getDescripcion();
	}
	
	/**
	 * Transforms a string (number) to an object (issue).
	 *
	 * @param  string $descripcion
	 * @return Especialidad|null
	 * @throws TransformationFailedException if object (especialidad) is not found.
	 */
	public function reverseTransform($descripcion)
	{
		if (!$descripcion) 
		{
			return null;
		}
	
		$especialidad = $this->om
		->getRepository('PruebasBundle:Especialidad')
		->findOneBy(array('descripcion' => $descripcion))
		;
	
		if (null === $especialidad)
		{			
			$especialidad = new Especialidad();
			$especialidad->setDescripcion($descripcion);
			$this->om->persist($especialidad);
			$this->om->flush();
		}
	
		return $especialidad;
	}
	
}