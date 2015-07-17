<?php

namespace IM\SysTurBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IM\SysTurBundle\Entity\Attachement;
use IM\SysTurBundle\Form\AttachementType;

/**
 * Attachement controller.
 *
 */
class AttachementController extends Controller
{

    /**
     * Creates a new Attachement entity.
     *
     */
    public function createAction(Request $request, $id_documento, $filter)
    {
        $em = $this->getDoctrine()->getManager();
        
        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }
        
        // Buscamos el documento
        $documento = $em->getRepository('IMSysTurBundle:Documento')->find($id_documento);
        if (!$documento) {
            throw $this->createNotFoundException('No es posible localizar el documento: '.$id_documento);
        }
        
        $entity = new Attachement();
        $form = $this->createCreateForm($entity, $id_documento, $filter);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('IMSysTurBundle_editDocumento', array('id' => $documento->getId(), 'filter'=>$filter)));
        }

        return $this->render('IMSysTurBundle:Attachement:newAttachement.html.twig', array(
            'parameters' => $parameters,
            'entity' => $entity,
            'edit_form'   => $form->createView(),
            'documento' => $documento,
            'filter' => $filter,
        ));
    }

    /**
     * Creates a form to create a Attachement entity.
     *
     * @param Attachement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Attachement $entity, $id_documento, $filter)
    {
        $form = $this->createForm(new AttachementType(), $entity, array(
            'action' => $this->generateUrl('IMSysTurBundle_createAttachement', array('id_documento'=>$id_documento, 'filter'=>$filter)),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Attachement entity.
     *
     */
    public function newAction($id_documento, $filter)
    {
        $em = $this->getDoctrine()->getManager();
        
        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }
        
        // Buscamos el documento
        $documento = $em->getRepository('IMSysTurBundle:Documento')->find($id_documento);
        if (!$documento) {
            throw $this->createNotFoundException('No es posible localizar el documento: '.$id_documento);
        }
        
        $entity = new Attachement();
        $entity->setTabla('documento');
        $entity->setIdSource($id_documento);
        $form   = $this->createCreateForm($entity, $id_documento, $filter);

        return $this->render('IMSysTurBundle:Attachement:newAttachement.html.twig', array(
            'parameters' => $parameters,
            'entity' => $entity,
            'edit_form'   => $form->createView(),
            'filter' => $filter,
            'documento' => $documento,
        ));
    }

    /**
     * Deletes a Attachement entity.
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
        
        // Buscamos el attachement
        $attachement = $em->getRepository('IMSysTurBundle:Attachement')->find($id);
        if (!$attachement) {
            throw $this->createNotFoundException('No es posible localizar el archivo adjunto: '.$id);
        }
        
        // Guardamos el id del documento que lo contenía
        $idSource = $attachement->getIdSource();
        $source = $attachement->getTabla();
        
        switch($source) {
            case 'documento':   $destino = 'IMSysTurBundle_editDocumento';
                                break;
        }
        
        $em->remove($attachement);
        $em->flush();

        return $this->redirect($this->generateUrl($destino, array('id'=>$idSource, 'filter'=>$filter)));
    }

}
