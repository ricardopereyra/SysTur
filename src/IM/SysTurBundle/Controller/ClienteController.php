<?php

namespace IM\SysTurBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IM\SysTurBundle\Entity\Cliente;
use IM\SysTurBundle\Form\ClienteType;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller
{

    /**
     * Lists all Cliente entities.
     */
    public function indexAction($filter) {
        $em = $this->getDoctrine()->getManager();
        
        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }
        
        return $this->render('IMSysTurBundle:Cliente:listar.html.twig', array(
            'parameters' => $parameters,
            'filter' => $filter,
        ));
    }
    
    /**
     * Devuelve el listado de clientes
     */
    public function getClientesAction($filter) {
        $em = $this->getDoctrine()->getManager();
        
        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }
        
        // Buscamos los clientes
        if ($filter=="*") {
            $clientes = $em->getRepository('IMSysTurBundle:Cliente')->findAllActive();
        }
        else {
            $clientes = $em->getRepository('IMSysTurBundle:Cliente')->findAllByCriteria($filter);
        }

        
        return $this->render('IMSysTurBundle:Cliente:getClientes.html.twig', array(
            'filter' => $filter,
            'clientes' => $clientes,
        ));
    }


    /**
     * Creates a new Cliente entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }
        
        $entity = new Cliente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('IMSysTurBundle_ListarClientes'));
        }

        return $this->render('IMSysTurBundle:Cliente:newCliente.html.twig', array(
            'parameters' => $parameters,
            'entity' => $entity,
            'edit_form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Cliente entity.
     *
     * @param Cliente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cliente $entity)
    {
        $form = $this->createForm(new ClienteType(), $entity, array(
            'action' => $this->generateUrl('IMSysTurBundle_createCliente'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Cliente entity.
     *
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }
        
        $entity = new Cliente();
        $form   = $this->createCreateForm($entity);

        return $this->render('IMSysTurBundle:Cliente:newCliente.html.twig', array(
            'parameters' => $parameters,
            'entity' => $entity,
            'edit_form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cliente entity.
     *
     */
    public function editAction($id, $filter)
    {
        $em = $this->getDoctrine()->getManager();
        
        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }

        $entity = $em->getRepository('IMSysTurBundle:Cliente')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('No es posible localizar el cliente.');
        }
        
        $documentos = $em->getRepository('IMSysTurBundle:Cliente')->getDocumentos($id);
        $contactos = $em->getRepository('IMSysTurBundle:Cliente')->getContactos($id);

        $editForm = $this->createEditForm($entity, $filter);

        return $this->render('IMSysTurBundle:Cliente:editCliente.html.twig', array(
            'parameters' => $parameters,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'filter'    => $filter,
            'documentos' => $documentos,
            'contactos' => $contactos,
        ));
    }

    /**
    * Creates a form to edit a Cliente entity.
    *
    * @param Cliente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cliente $entity, $filter)
    {
        $form = $this->createForm(new ClienteType(), $entity, array(
            'action' => $this->generateUrl('IMSysTurBundle_UpdateCliente', array('id' => $entity->getId(), 'filter' => $filter)),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Cliente entity.
     *
     */
    public function updateAction(Request $request, $id, $filter) {
        $em = $this->getDoctrine()->getManager();
        
        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }

        $entity = $em->getRepository('IMSysTurBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No es posible encontrar el cliente.');
        }

        $editForm = $this->createEditForm($entity, $filter);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $em->flush();

            return $this->redirect($this->generateUrl('IMSysTurBundle_ListarClientes', array('filter' => $filter)));
        }

        return $this->render('IMSysTurBundle:Cliente:editCliente.html.twig', array(
            'parameters' => $parameters,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'filter'    => $filter,
        ));
    }
    
    /**
     * Deletes a Cliente entity.
     *
     */
    public function deleteAction($id, $filter)
    {
        $em = $this->getDoctrine()->getManager();
        
        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }

        $entity = $em->getRepository('IMSysTurBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No es posible encontrar el cliente.');
        }
        
        $entity->setFechaBaja(new \DateTime("now"));
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('IMSysTurBundle_ListarClientes', array('filter' => $filter)));
    }

    /**
     * Creates a form to delete a Cliente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cliente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
