<?php

namespace TestWeb\PruebasBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TestWeb\PruebasBundle\Entity\Turno;
use TestWeb\PruebasBundle\Form\TurnoType;
use TestWeb\PruebasBundle\Form\DoctorType;
use Symfony\Component\HttpFoundation\JsonResponse;
use TestWeb\PruebasBundle\Entity\Doctor;


/**
 * Turno controller.
 *
 * @Route("/turno")
 */
class TurnoController extends Controller
{
    /**
     * Lists all Turno entities.
     *
     * @Route("/", name="turno")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('PruebasBundle:Turno')->findAll();
        return array('entities' => $entities,);
    }

    /**
     * Finds and displays a Turno entity.
     *
     * @Route("/{id}/show", name="turno_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PruebasBundle:Turno')->find($id);

        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Turno entity.');
        }

        $form = $this->createForm(new TurnoType(), $entity);
        return array('entity'=> $entity,'form' => $form->createView(),);
    }

    /**
     * Displays a form to create a new Turno entity.
     *
     * @Route("/new", name="turno_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Turno();
        $request = $this->getRequest();
        $form   = $this->createForm(new TurnoType(), $entity);
        
        if ($request->isMethod("POST"))
        {
        	$form->bind($request);
        	if ($form->isValid())
        	{
        		$em = $this->getDoctrine()->getManager();
        		$em->persist($entity);
        		$em->flush();
        		return $this->redirect($this->generateUrl('turno', array()));
        	}
        }
        return array('entity'=>$entity,'form'=>$form->createView(),);
    }

    /**
     * Displays a form to edit an existing Turno entity.
     *
     * @Route("/{id}/edit", name="turno_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PruebasBundle:Turno')->find($id);
        $request = $this->getRequest();        
        
        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Turno entity.');
        }
        
        $editForm = $this->createForm(new TurnoType(), $entity);       
        
        if ($request->isMethod("POST"))
        {
        	$editForm->bind($request);
        	if ($editForm->isValid())
        	{
        		$em->persist($entity);
        		$em->flush();
        		return $this->redirect($this->generateUrl('turno', array()));
        	}
        }        
        return array('entity'=>$entity,'edit_form'=>$editForm->createView());
    }

   
    /**
     * Deletes a Turno entity.
     *
     * @Route("/{id}/delete", name="turno_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
    	    $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PruebasBundle:Turno')->find($id);

            if (!$entity)
            {
                throw $this->createNotFoundException('Unable to find Turno entity.');
            }

            $em->remove($entity);
            $em->flush();
        

        return $this->redirect($this->generateUrl('turno'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * @Route("/borrarTurnos", name="borrarTurnos")
     */
    public function borrarTurnos()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entities = $em->getRepository('PruebasBundle:Turno')->findAll();
    	foreach ($entities as $turno)
    	{
    		$em->remove($turno);
    		$em->flush();
    	}
    	return new Response(1);
    	
    }
    
    /**
     * Lists all Turno entities.
     *
     * @Route("/tabs", name="tabs")
     * @Template()
     */
    public function tabsAction()
    {
		return array();
    }
    
    /**
     *
     * @Route("/devolverAlgo", name="devolverAlgo")
     */
    public function devolverAlgo()
    {
    	return new Response(12);
    }
    
    /**
     *
     * @Route("/devolverJSON", name="devolverJSON")
     */
    public function devolverJSON()
    {
     	 $em = $this->getDoctrine()->getManager();
        $doctoresDB = $em->getRepository('PruebasBundle:Doctor')->findAll();

        $doctores = array();
        $i = 0;
     	foreach ($doctoresDB as $doctor) 
     	{	     		
     		$doctores[$i] = $this->devolverDoctor($doctor);
           	$i++;
        }
        return new JsonResponse($doctores);
    }
    
    private function devolverDoctor(Doctor $doctor)
    {
    	$em = $this->getDoctrine()->getManager();
    	$id =  $doctor->getId();
    	$doctorDB = $em->getRepository('PruebasBundle:Doctor')->find($id);
    	if (!$doctorDB)
    	{
    		throw $this->createNotFoundException('Unable to find Doctor entity.');
    	}
    	$resul["data"]=$doctorDB->getNombre();
       	$resul["state"]="open";
       	$attr["id"]=$doctorDB->getId();
       	$resul["attr"]=$attr;       	
       	
    	return $resul;
    
    }
    
    /**
     * Lists all Turno entities.
     *
     * @Route("/arbol", name="arbol")
     * @Template()
     */
    public function arbolAction()
    {
//     	$em = $this->getDoctrine()->getManager();
//     	$doctoresDB = $em->getRepository('PruebasBundle:Doctor')->findAll();
    	
//     	$doctores = array();
//     	$i = 0;
//     	foreach ($doctoresDB as $doctor)
//     	{
//     		$doctores[$i] = $this->devolverDoctor($doctor);
//     		$i++;
//     	}
//     	$serializer = $this->container->get('serializer');
//     	$report = $serializer->serialize($result, 'json');
//        return $this
// 				->render('PruebasBundle:Turno:arbol.html.twig',
// 						array('data' => $report));
		return array();
    }
    
    /**
     * @Route("/dialog", name="dialog")
     * @Template()
     */
    public function dialogAction()
    {
    	return array();
    }
    
    /**
     * @Route("/autocomplete", name="autocomplete")
     * @Template()
     */
    public function autocompleteAction()
    {
    	return array();
    }
}
