<?php

namespace TestWeb\PruebasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TestWeb\PruebasBundle\Entity\Doctor;
use TestWeb\PruebasBundle\Form\DoctorType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Doctor controller.
 *
 * @Route("/doctor")
 */
class DoctorController extends Controller
{
    /**
     * Lists all Doctor entities.
     *
     * @Route("/", name="doctor")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('PruebasBundle:Doctor')->findAll();
        return array('entities' => $entities,);
    }
    
    /**
     * 
     * @Route("/doctoresAjax", name="doctoresAjax")
     * 
     */
    public function devolverDoctoresAction()
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
    
    /**
     *
     * @Route("/doctoresAjaxFiltro/{nombreDoctor}", name="doctoresAjaxFiltro")
     *
     */
    public function devolverDoctoresFiltro($nombreDoctor)
    {
    	$em = $this->getDoctrine()->getManager();
    	$repository = $em->getRepository('PruebasBundle:Doctor');
    	
    	$query = $repository->createQueryBuilder('d')
    	->where('d.nombre LIKE :nombre')
    	->setParameter('nombre', '%'.$nombreDoctor.'%')
    	->getQuery();
    	
    	$doctoresDB = $query->getResult();    
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
    	$resul["Id"]=$doctorDB->getId();
    	$resul["Apellido"]=$doctorDB->getApellido();
    	$resul["Nombre"]=$doctorDB->getNombre();
    	$resul["Dni"]=$doctorDB->getDni();
    	$resul["Fecha"]=$doctorDB->getFechaNacimiento();
    	return $resul;

    }
    
    

    /**
     * Finds and displays a Doctor entity.
     *
     * @Route("/{id}/show", name="doctor_show")
     * 
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PruebasBundle:Doctor')->find($id);

        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Doctor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Doctor entity.
     *
     * @Route("/new", name="doctor_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Doctor();
        $form   = $this->createForm(new DoctorType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Doctor entity.
     *
     * @Route("/create", name="doctor_create")
     * @Method("POST")
     * @Template("PruebasBundle:Doctor:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Doctor();
        $form = $this->createForm(new DoctorType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('doctor_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Doctor entity.
     *
     * @Route("/{id}/edit", name="doctor_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PruebasBundle:Doctor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doctor entity.');
        }

        $editForm = $this->createForm(new DoctorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Doctor entity.
     *
     * @Route("/{id}/update", name="doctor_update")
     * @Method("POST")
     * @Template("PruebasBundle:Doctor:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PruebasBundle:Doctor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doctor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DoctorType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('doctor_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Doctor entity.
     *
     * @Route("/{id}/delete", name="doctor_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PruebasBundle:Doctor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Doctor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('doctor'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
