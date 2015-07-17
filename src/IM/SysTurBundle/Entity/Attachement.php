<?php

namespace IM\SysTurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Attachement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="IM\SysTurBundle\Entity\AttachementRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Attachement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla", type="string", length=255)
     */
    private $tabla;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_source", type="integer")
     */
    private $idSource;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="nota", type="text")
     */
    private $nota;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tabla
     *
     * @param string $tabla
     * @return Attachement
     */
    public function setTabla($tabla)
    {
        $this->tabla = $tabla;

        return $this;
    }

    /**
     * Get tabla
     *
     * @return string 
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Attachement
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set nota
     *
     * @param string $nota
     * @return Attachement
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return string 
     */
    public function getNota()
    {
        return $this->nota;
    }
    
    /* 
     * Métodos relacionados con el upload de archivos
     * 
     */
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // la ruta absoluta del directorio donde se deben
        // guardar los archivos cargados
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // se deshace del __DIR__ para no meter la pata
        // al mostrar el documento/imagen cargada en la vista.
        return 'images/documentos/attachements';
    }
    
    /**
     * @Assert\Image(
     *     maxSize = "400k",
     *     maxSizeMessage = "El archivo seleccionado es muy grande: ({{ size }} {{ suffix }}). El tamaño máximo permitido es {{ limit }} {{ suffix }}",
     *     mimeTypes = {"image/jpeg"},
     *     mimeTypesMessage = "El tipo de archivo seleccionado es inválido: ({{ type }}). Por favor seleccione una imágen JPG"
     * 
     * )
     */
    private $file;
    
    /**
     * Temporal
     */
    private $temp;


    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // haz lo que quieras para generar un nombre único
            $filename = 'doc_attachemtent_' . $this->id . '_' . mt_rand(0,9999);
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // si hay un error al mover el archivo, move() automáticamente
        // envía una excepción. This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
    

    /**
     * Set idSource
     *
     * @param integer $idSource
     * @return Attachement
     */
    public function setIdSource($idSource)
    {
        $this->idSource = $idSource;

        return $this;
    }

    /**
     * Get idSource
     *
     * @return integer 
     */
    public function getIdSource()
    {
        return $this->idSource;
    }
}
