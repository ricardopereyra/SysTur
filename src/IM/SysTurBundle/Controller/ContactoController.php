<?php

namespace IM\SysTurBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IM\SysTurBundle\Entity\Contacto;
use IM\SysTurBundle\Form\ContactoType;

/**
 * Contacto controller.
 *
 */
class ContactoController extends Controller
{

    /**
     * Lists all Contacto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IMSysTurBundle:Contacto')->findAll();

        return $this->render('IMSysTurBundle:Contacto:listar.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Contacto entity.
     *
     */
    public function createAction(Request $request, $idCliente, $filter)
    {
        $em = $this->getDoctrine()->getManager();

        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }
        
        $cliente = $em->getRepository('IMSysTurBundle:Cliente')->find($idCliente);
        if (!$cliente) {
            throw $this->createNotFoundException('No es posible localizar al cliente: '.$idCliente);
        }

        $entity = new Contacto();
        $form = $this->createCreateForm($entity, $idCliente, $filter);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setCliente($cliente);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('IMSysTurBundle_EditCliente', array('id' => $idCliente, 'filter'=>$filter)));
        }

        return $this->render('IMSysTurBundle:Contacto:newContacto.html.twig', array(
            'parameters' => $parameters,
            'entity' => $entity,
            'edit_form'   => $form->createView(),
            'filter' => $filter,
        ));
    }

    /**
     * Creates a form to create a Contacto entity.
     *
     * @param Contacto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Contacto $entity, $idCliente, $filter)
    {
        $form = $this->createForm(new ContactoType(), $entity, array(
            'action' => $this->generateUrl('IMSysTurBundle_createContacto', array('idCliente'=>$idCliente, 'filter'=>$filter)),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Contacto entity.
     *
     */
    public function newAction($idCliente, $filter)
    {
        $em = $this->getDoctrine()->getManager();

        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }
        
        $cliente = $em->getRepository('IMSysTurBundle:Cliente')->find($idCliente);
        if (!$cliente) {
            throw $this->createNotFoundException('No es posible localizar al cliente: '.$idCliente);
        }
        
        $entity = new Contacto();
        $entity->setCliente($cliente);
        $form   = $this->createCreateForm($entity, $idCliente, $filter);

        return $this->render('IMSysTurBundle:Contacto:newContacto.html.twig', array(
            'parameters' => $parameters,
            'entity' => $entity,
            'edit_form'   => $form->createView(),
            'filter' => $filter,
        ));
    }

    /**
     * Finds and displays a Contacto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IMSysTurBundle:Contacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contacto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IMSysTurBundle:Contacto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contacto entity.
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

        $entity = $em->getRepository('IMSysTurBundle:Contacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No es posible localizar el contacto: '.$id);
        }

        $editForm = $this->createEditForm($entity, $filter);

        return $this->render('IMSysTurBundle:Contacto:editContacto.html.twig', array(
            'parameters' => $parameters,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'filter' => $filter,
        ));
    }

    /**
    * Creates a form to edit a Contacto entity.
    *
    * @param Contacto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Contacto $entity, $filter)
    {
        $form = $this->createForm(new ContactoType(), $entity, array(
            'action' => $this->generateUrl('IMSysTurBundle_updateContacto', array('id' => $entity->getId(), 'filter'=>$filter)),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Contacto entity.
     *
     */
    public function updateAction(Request $request, $id, $filter)
    {
        $em = $this->getDoctrine()->getManager();

        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }

        $entity = $em->getRepository('IMSysTurBundle:Contacto')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('No es posible localizar el contacto: '.$id);
        }

        $editForm = $this->createEditForm($entity, $filter);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('IMSysTurBundle_EditCliente', array('id' => $entity->getCliente()->getId(), 'filter'=>$filter)));
        }

        return $this->render('IMSysTurBundle:Contacto:editContacto.html.twig', array(
            'parameters' => $parameters,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'filter' => $filter,
        ));
    }
    
    /**
     * Deletes a Contacto entity.
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
        
        $entity = $em->getRepository('IMSysTurBundle:Contacto')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('No es posible localizar el contacto: '.$id);
        }
        
        $entity->setFechaBaja(new \DateTime("now"));
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('IMSysTurBundle_EditCliente', array('id'=>$entity->getCliente()->getId(),'filter'=>$filter)));
    }

    /**
     * Creates a form to delete a Contacto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_contactos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
