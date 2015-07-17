<?php

namespace IM\SysTurBundle\Controller;

//use Proxies\__CG__\IM\SysTurBundle\Entity\Cliente;
use IM\SysTurBundle\Entity\ClienteFile;
use IM\SysTurBundle\Entity\Seguimiento;
use IM\SysTurBundle\IMSysTurBundle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use IM\SysTurBundle\Entity\File;
use IM\SysTurBundle\Form\FileType;
use IM\SysTurBundle\Entity\Cliente;

/**
 * File controller.
 *
 */
class FileController extends Controller
{

    /**
     * Lists all File entities.
     *
     */
    public function indexAction($filter)
    {
        $em = $this->getDoctrine()->getManager();

        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }

        return $this->render('IMSysTurBundle:File:listar.html.twig', array(
            'parameters' => $parameters,
            'filter' => $filter,
        ));
    }

    /**
     * Devuelve el listado de files
     */
    public function getFilesAction($filter) {
        $em = $this->getDoctrine()->getManager();

        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }

        // Buscamos los files
        if ($filter=="*") {
            $files = $em->getRepository('IMSysTurBundle:File')->findAllActive();
        }
        else {
            $files = $em->getRepository('IMSysTurBundle:File')->findAllByCriteria($filter);
        }


        return $this->render('IMSysTurBundle:File:getFiles.html.twig', array(
            'filter' => $filter,
            'files' => $files,
        ));
    }

    /**
     * Creates a new File entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new File();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_file_show', array('id' => $entity->getId())));
        }

        return $this->render('IMSysTurBundle:File:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a File entity.
     *
     * @param File $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(File $entity)
    {
        $form = $this->createForm(new FileType(), $entity, array(
            'action' => $this->generateUrl('admin_file_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new File entity.
     *
     */
    public function newAction()
    {
        $entity = new File();
        $form   = $this->createCreateForm($entity);

        return $this->render('IMSysTurBundle:File:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a File entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IMSysTurBundle:File')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IMSysTurBundle:File:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing File entity.
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

        $file = $em->getRepository('IMSysTurBundle:File')->find($id);
        if (!$file) {
            throw $this->createNotFoundException('No es posible localizar el file.');
        }

        $tipoSeguimiento = $em->getRepository("IMSysTurBundle:TipoSeguimiento")->findAll();
        $empleados = $em->getRepository("IMSysTurBundle:Empleado")->findAll();

        $editForm = $this->createEditForm($file, $filter);

        return $this->render('IMSysTurBundle:File:editFile.html.twig', array(
            'parameters' => $parameters,
            'file'      => $file,
            'form'   => $editForm->createView(),
            'filter'    => $filter,
            'tipoSeguimiento' => $tipoSeguimiento,
            'empleados' => $empleados,
        ));

    }

    /**
    * Creates a form to edit a File entity.
    *
    * @param File $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(File $entity, $filter)
    {
        $form = $this->createForm(new FileType(), $entity, array(
            'action' => $this->generateUrl('IMSysTurBundle_UpdateFile', array('id' => $entity->getId(), 'filter'=>$filter)),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing File entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IMSysTurBundle:File')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find File entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_file_edit', array('id' => $id)));
        }

        return $this->render('IMSysTurBundle:File:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a File entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IMSysTurBundle:File')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find File entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_file'));
    }

    /**
     * Creates a form to delete a File entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_file_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Crea un formulario para agregar un cliente
     *
     * @param $request. El formulario
     * @param $id. El id del file
     * @param $filter. El filtro de búsqueda activo
     *
     * @return una vista.
     */
    public function asignarClienteAction(Request $request, $id, $filter) {
        $em = $this->getDoctrine()->getManager();

        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }

        // Buscamos el file
        $file = $em->getRepository('IMSysTurBundle:File')->find($id);
        if (!$file) {
            throw $this->createNotFoundException('No es posible localizar el file.');
        }

        // Creamos el formulario
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('IMSysTurBundle_UpdateClientesXFile', array('id' => $file->getId(), 'filter'=>$filter)))
            ->add('apellido', 'text')
            ->add('nombres', 'text')
            ->add('dni', 'text')
            ->getForm();

        return $this->render('IMSysTurBundle:File:NuevoCliente.html.twig', array(
            'parameters' => $parameters,
            'file'      => $file,
            'form'   => $form->createView(),
            'filter'    => $filter,
        ));
    }

    public function updateClienteXFileAction(Request $request, $id, $filter) {
        $em = $this->getDoctrine()->getManager();

        // Leemos los parámetros
        $parameters = $em->getRepository('IMSysTurBundle:Parameters')->find(1);
        if (!$parameters) {
            throw $this->createNotFoundException('No se pueden encontrar los parámetros de sistema.');
        }

        // Buscamos el file
        $file = $em->getRepository('IMSysTurBundle:File')->find($id);
        if (!$file) {
            throw $this->createNotFoundException('No es posible localizar el file.');
        }
    }

    /**
     * Devuelve el listado de clientes
     */
    public function getClientesXFileAction(Request $request, $id) {
        $error = '';
        $em = $this->getDoctrine()->getManager();

        // Buscamos el file
        $file = $em->getRepository('IMSysTurBundle:File')->find($id);
        if (!$file) {
            throw $this->createNotFoundException('No es posible localizar el file.');
        }

        // Obtenemos los valores enviados por post
        $dni = $this->get('request')->request->get('dni');
        $apellido = $this->get('request')->request->get('apellido');
        $nombres = $this->get('request')->request->get('nombres');

        // Si se envió el dni por post, insertamos un cliente
        if ($dni) {
            $cliente = $em->getRepository('IMSysTurBundle:Cliente')->findOneByDni($dni);
            // Si no existe el cliente, lo creamos
            if (!$cliente) {
                $cliente = new Cliente();
                $cliente->setApellido($apellido);
                $cliente->setNombres($nombres);
                $cliente->setDni($dni);
                $em->persist($cliente);
            }
            // Ahora asignamos el cliente al file
            $clienteFile = new ClienteFile();
            $clienteFile->setFile($file);
            $clienteFile->setCliente($cliente);
            $em->persist($clienteFile);
            try {
                $em->flush();
            } catch(\Doctrine\DBAL\DBALException $e) {
                switch ($e->getPrevious()->errorInfo[1]) {
                    case 1062: $error = 'Cliente ya se encuentra asignado. No es posible asignar dos veces el mismo cliente al file.'; break;
                    default: $error = $e->getPrevious()->getMessage(); break;
                }
            } catch(\Exception $e){
                $error = 'Ha ocurrido un error general al guardar.<br />';
            }
        }

        return $this->render('IMSysTurBundle:File:ClientesXFile.html.twig', array(
            'error' => $error,
            'file' => $file,
        ));
    }

    /**
     * Elimina un clientex file y devuelve el listado de clientes
     */
    public function deleteClientesXFileAction(Request $request, $id) {
        $error = '';
        $em = $this->getDoctrine()->getManager();

        // Buscamos el file
        $file = $em->getRepository('IMSysTurBundle:File')->find($id);
        if (!$file) {
            throw $this->createNotFoundException('No es posible localizar el file.');
        }

        // Obtenemos los valores enviados por post
        $idcliente = $this->get('request')->request->get('idcliente');

        // Encontramos el registro y lo eliminamos
        $clientexfile = $em->getRepository("IMSysTurBundle:ClienteFile")->getOneByClienteFile($id, $idcliente);
        if ($clientexfile) {
            $em->remove($clientexfile);
            try {
                $em->flush();
            } catch(\Doctrine\DBAL\DBALException $e) {
                switch ($e->getPrevious()->errorInfo[1]) {
                    //case 1062: $error = 'Cliente ya se encuentra asignado. No es posible asignar dos veces el mismo cliente al file.'; break;
                    default: $error = $e->getPrevious()->getMessage(); break;
                }
            } catch(\Exception $e){
                $error = 'Ha ocurrido un error general al guardar.<br />';
            }
        }

        return $this->render('IMSysTurBundle:File:ClientesXFile.html.twig', array(
            'error' => $error,
            'file' => $file,
        ));
    }

    /**
     * Devuelve el listado de seguimientos de un file
     */
    public function getSeguimientoFileAction(Request $request, $id) {
        $error = '';
        $em = $this->getDoctrine()->getManager();

        // Buscamos el file
        $file = $em->getRepository('IMSysTurBundle:File')->find($id);
        if (!$file) {
            throw $this->createNotFoundException('No es posible localizar el file.');
        }

        // Obtenemos los valores enviados por post
        $idEmpleado = $this->get('request')->request->get('empleado');
        $idTipo = $this->get('request')->request->get('tipo');
        $descripcion = $this->get('request')->request->get('descripcion');

        if ($idEmpleado) {
            // Buscamos el empleado
            $empleado = $em->getRepository("IMSysTurBundle:Empleado")->find($idEmpleado);
            if (!$empleado) {
                throw $this->createNotFoundException("No se encuentra el empleado");
            }

            // Buscamos el tipo
            $tipo = $em->getRepository("IMSysTurBundle:TipoSeguimiento")->find($idTipo);
            if (!$tipo) {
                throw $this->createNotFoundException("No es posible encontrar el tipo de seguimiento.");
            }

            // Agregamos el registro
            $seguimiento = new Seguimiento();
            $seguimiento->setFile($file);
            $seguimiento->setEmpleado($empleado);
            $seguimiento->setDescripcion($descripcion);
            $seguimiento->setTipo($tipo);
            $em->persist($seguimiento);

            try {
                $em->flush();
            } catch(\Doctrine\DBAL\DBALException $e) {
                switch ($e->getPrevious()->errorInfo[1]) {
                    //case 1062: $error = 'Cliente ya se encuentra asignado. No es posible asignar dos veces el mismo cliente al file.'; break;
                    default: $error = $e->getPrevious()->getMessage(); break;
                }
            } catch(\Exception $e){
                $error = 'Ha ocurrido un error general al guardar.<br />';
            }
        }

        return $this->render('IMSysTurBundle:File:seguimientoFile.html.twig', array(
            'error' => $error,
            'file' => $file,
        ));
    }


}
