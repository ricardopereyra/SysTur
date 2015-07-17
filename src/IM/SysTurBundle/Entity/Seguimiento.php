<?php

namespace IM\SysTurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seguimiento
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="IM\SysTurBundle\Entity\SeguimientoRepository")
 */
class Seguimiento
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
     * @ORM\ManyToOne(targetEntity="File", inversedBy="seguimientos")
     * @ORM\JoinColumn(name="file", referencedColumnName="id")
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="TipoSeguimiento", inversedBy="seguimientos")
     * @ORM\JoinColumn(name="tipo", referencedColumnName="id")
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Empleado", inversedBy="seguimientos")
     * @ORM\JoinColumn(name="empleado", referencedColumnName="id")
     */
    private $empleado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime", nullable=true)
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaBaja", type="datetime", nullable=true)
     */
    private $fechaBaja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=true)
     */
    private $fechaModificacion;

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
     * Set file
     *
     * @param integer $file
     * @return Seguimiento
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return integer 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Seguimiento
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Seguimiento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set empleado
     *
     * @param integer $empleado
     * @return Seguimiento
     */
    public function setEmpleado($empleado)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return integer 
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Seguimiento
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set fechaBaja
     *
     * @param \DateTime $fechaBaja
     * @return Seguimiento
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Get fechaBaja
     *
     * @return \DateTime 
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Seguimiento
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
}
