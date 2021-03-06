<?php

namespace TestWeb\PruebasBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TestWeb\PruebasBundle\Entity\Paciente;
use TestWeb\PruebasBundle\Form\PacienteType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Paciente controller.
 *
 * @Route("/paciente")
 */
class PacienteController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     * @Route("/", name="paciente")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PruebasBundle:Paciente')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Paciente entity.
     *
     * @Route("/{id}/show", name="paciente_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PruebasBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Paciente entity.
     *
     * @Route("/new", name="paciente_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Paciente();
        $form   = $this->createForm(new PacienteType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Paciente entity.
     *
     * @Route("/create", name="paciente_create")
     * @Method("POST")
     * @Template("PruebasBundle:Paciente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Paciente();
        $form = $this->createForm(new PacienteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paciente_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Paciente entity.
     *
     * @Route("/{id}/edit", name="paciente_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PruebasBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $editForm = $this->createForm(new PacienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Paciente entity.
     *
     * @Route("/{id}/update", name="paciente_update")
     * @Method("POST")
     * @Template("PruebasBundle:Paciente:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PruebasBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PacienteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paciente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Paciente entity.
     *
     * @Route("/{id}/delete", name="paciente_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PruebasBundle:Paciente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Paciente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paciente'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * 
     *
     * @Route("/{id}/cantidad_turnos", name="cantidad_turnos")
     * @Method("GET")
     */
    public function cantidadTurnosAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$paciente = $em->getRepository('PruebasBundle:Paciente')->find($id);
    	$turnos = $em->getRepository('PruebasBundle:Turno')->findByPaciente($paciente);
    	$cantidad = count($turnos);
    	return new Response($cantidad);
    }
    
    /**
     *
     * @Route("/pacientesAjaxFiltro/{nombrePaciente}", name="pacientesAjaxFiltro")
     *
     */
    public function devolverPacientesFiltro($nombrePaciente)
    {
    	$em = $this->getDoctrine()->getManager();
    	$repository = $em->getRepository('PruebasBundle:Paciente');
    	 
    	$query = $repository->createQueryBuilder('p')
    	->where('p.nombre LIKE :nombre')
    	->setParameter('nombre', '%'.$nombrePaciente.'%')
    	->getQuery();
    	 
    	$pacientesDB = $query->getResult();
    	$pacientes = array();
    	$i = 0;
    	 
    	foreach ($pacientesDB as $paciente)
    	{
    		$pacientes[$i] = $this->devolverPaciente($paciente);
    		$i++;
    	}
    	return new JsonResponse($pacientes);
    }
    
    private function devolverPaciente(Paciente $paciente)
    {
    	$em = $this->getDoctrine()->getManager();
    	$id =  $paciente->getId();
    	$pacienteDB = $em->getRepository('PruebasBundle:Paciente')->find($id);
    	if (!$pacienteDB)
    	{
    		throw $this->createNotFoundException('Unable to find Paciente entity.');
    	}
    	$resul["Id"]=$pacienteDB->getId();
    	$resul["Apellido"]=$pacienteDB->getApellido();
    	$resul["Nombre"]=$pacienteDB->getNombre();
    	$resul["Dni"]=$pacienteDB->getDni();
    	$resul["Fecha"]=$pacienteDB->getFechaNacimiento();
    	return $resul;
    
    }
}
