<?php

namespace TestWeb\PruebasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use TestWeb\PruebasBundle\Entity\Especialidad;


/**
 * Especialiad controller.
 *
 * @Route("/especialidad")
 */
class EspecialidadController extends Controller
{
    /**
     * @Route("/showEspecialidades/{nombreEspecialidad}", name = "showEspecialidades")
      */
    public function showEspecialidades($nombreEspecialidad)
    {
    	$em = $this->getDoctrine()->getManager();
    	$repository = $em->getRepository('PruebasBundle:Especialidad');
    	
    	$query = $repository->createQueryBuilder('e')
    	->where('e.descripcion LIKE :descripcion')
    	->setParameter('descripcion', $nombreEspecialidad.'%')
    	->getQuery();
    	
    	$especialiadDB = $query->getResult();    
    	$especialidades = array();    	
    	$i = 0;
    	
    	foreach ($especialiadDB as $especialidad)
    	{
    		$especialidades[$i] = $this->devolverEspecialidad($especialidad);
    		$i++;
    	}
    	return new JsonResponse($especialidades);
    }
    
    private function devolverEspecialidad(Especialidad $especialiad)
    {
    	$em = $this->getDoctrine()->getManager();
    	$id =  $especialiad->getId();
    	$especialiadDB = $em->getRepository('PruebasBundle:Especialidad')->find($id);
    	if (!$especialiadDB)
    	{
    		throw $this->createNotFoundException('Unable to find Doctor entity.');
    	}
    	$resul["Id"]=$especialiadDB->getId();
    	$resul["Descripcion"]=$especialiadDB->getDescripcion();
    	
    	return $resul;
    
    }
    
}
