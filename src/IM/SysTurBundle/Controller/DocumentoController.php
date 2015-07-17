<?php

namespace IM\SysTurBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IM\SysTurBundle\Entity\Documento;
use IM\SysTurBundle\Form\DocumentoType;

/**
 * Documento controller.
 *
 */
class DocumentoController extends Controller
{

    /**
     * Lists all Documento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IMSysTurBundle:Documento')->findAll();

        return $this->render('IMSysTurBundle:Documento:listar.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Documento entity.
     *
     */
    public function createAction(Request $request, $filter)
    {
        $em = $this->getDoctrine()->getManager();

        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }
        
        $entity = new Documento();
        $form = $this->createCreateForm($entity, $filter);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('IMSysTurBundle_EditCliente', array('id' => $entity->getCliente()->getId(), 'filter'=>$filter)));
        }

        return $this->render('IMSysTurBundle:Documento:newDocumento.html.twig', array(
            'parameters'  => $parameters,
            'entity'      => $entity,
            'edit_form'   => $form->createView(),
            'filter'      => $filter,
        ));
    }

    /**
     * Creates a form to create a Documento entity.
     *
     * @param Documento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Documento $entity, $filter)
    {
        $form = $this->createForm(new DocumentoType(), $entity, array(
            'action' => $this->generateUrl('IMSysTurBundle_createDocumento', array('filter'=>$filter)),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Documento entity.
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
            throw $this->createNotFoundException('No es posible localizar el cliente '.$idCliente);
        }
        
        $entity = new Documento();
        $entity->setCliente($cliente);
        $form   = $this->createCreateForm($entity, $filter);


        return $this->render('IMSysTurBundle:Documento:newDocumento.html.twig', array(
            'parameters'  => $parameters,
            'entity'      => $entity,
            'edit_form'   => $form->createView(),
            'filter'      => $filter,
        ));
    }

    /**
     * Finds and displays a Documento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IMSysTurBundle:Documento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IMSysTurBundle:Documento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Documento entity.
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
        
        $entity = $em->getRepository('IMSysTurBundle:Documento')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('No es posible localizar el documento '.$id);
        }
        
        $attachements = $em->getRepository('IMSysTurBundle:Attachement')->getAttachements('documento', $id);

        $editForm = $this->createEditForm($entity, $filter);

        return $this->render('IMSysTurBundle:Documento:editDocumento.html.twig', array(
            'parameters'  => $parameters,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'filter'      => $filter,
            'attachements' => $attachements,
        ));
    }

    /**
    * Creates a form to edit a Documento entity.
    *
    * @param Documento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Documento $entity, $filter)
    {
        $form = $this->createForm(new DocumentoType(), $entity, array(
            'action' => $this->generateUrl('IMSysTurBundle_updateDocumento', array('id' => $entity->getId(), 'filter'=>$filter)),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Documento entity.
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
        
        $entity = $em->getRepository('IMSysTurBundle:Documento')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('No es posible localizar el documento '.$id);
        }

        $editForm = $this->createEditForm($entity, $filter);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('IMSysTurBundle_EditCliente', array('id' => $entity->getCliente()->getId(), 'filter'=>$filter)));
        }

        return $this->render('IMSysTurBundle:Documento:editDocumento.html.twig', array(
            'parameters'  => $parameters,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'filter'      => $filter,
        ));
    }
    /**
     * Deletes a Documento entity.
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

        $entity = $em->getRepository('IMSysTurBundle:Documento')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('No es posible localizar el documento: '.$id);
        }
        
        $cantidadAttachements = $em->getRepository('IMSysTurBundle:Attachement')->getCantidad('documento', $id);
        if ($cantidadAttachements['cantidad'] > 0) {
            throw $this->createNotFoundException('No se puede eliminar el documento porque posee archivos adjuntos: '.$id);
        }
        
        $entity->setFechaBaja(new \DateTime("now"));
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('IMSysTurBundle_EditCliente', array('id'=>$entity->getCliente()->getId(), 'filter'=>$filter)));
    }

    /**
     * Creates a form to delete a Documento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('documento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
