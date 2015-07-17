<?php

namespace IM\SysTurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="IM\SysTurBundle\Entity\ClienteRepository")
 */
class Cliente
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
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", length=255, nullable=true)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255, nullable=true)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="localidad", type="string", length=255, nullable=true)
     */
    private $localidad;

    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=255, nullable=true)
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=255)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="cuil", type="string", length=255, nullable=true)
     */
    private $cuil;
    
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
     * @ORM\ManyToOne(targetEntity="Pais", inversedBy="clientes")
     * @ORM\JoinColumn(name="pais", referencedColumnName="id")
     */
    protected $pais;    
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoIva", inversedBy="clientes")
     * @ORM\JoinColumn(name="tipoIva", referencedColumnName="id")
     */
    protected $tipoIva;    
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoCliente", inversedBy="clientes")
     * @ORM\JoinColumn(name="tipoCliente", referencedColumnName="id")
     */
    protected $tipoCliente;
    
    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="clientes")
     * @ORM\JoinColumn(name="categoria", referencedColumnName="id")
     */
    protected $categoria;
    
    /**
     * @ORM\OneToMany(targetEntity="Contacto", mappedBy="cliente")
     */
    protected $contactos;
    
    /**
     * @ORM\OneToMany(targetEntity="Documento", mappedBy="cliente")
     */
    protected $documentos;

    /**
     * @ORM\OneToMany(targetEntity="ClienteFile", mappedBy="cliente")
     */
    protected $filesCliente;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contactos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->filesCliente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fechaAlta = new \DateTime("now");
    }

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
     * Set apellido
     *
     * @param string $apellido
     * @return Cliente
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     * @return Cliente
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Cliente
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     * @return Cliente
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     * @return Cliente
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Cliente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Cliente
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Cliente
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set cuil
     *
     * @param string $cuil
     * @return Cliente
     */
    public function setCuil($cuil)
    {
        $this->cuil = $cuil;

        return $this;
    }

    /**
     * Get cuil
     *
     * @return string 
     */
    public function getCuil()
    {
        return $this->cuil;
    }

    /**
     * Set pais
     *
     * @param \IM\SysTurBundle\Entity\Pais $pais
     * @return Cliente
     */
    public function setPais(\IM\SysTurBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \IM\SysTurBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set tipoIva
     *
     * @param \IM\SysTurBundle\Entity\TipoIva $tipoIva
     * @return Cliente
     */
    public function setTipoIva(\IM\SysTurBundle\Entity\TipoIva $tipoIva = null)
    {
        $this->tipoIva = $tipoIva;

        return $this;
    }

    /**
     * Get tipoIva
     *
     * @return \IM\SysTurBundle\Entity\TipoIva 
     */
    public function getTipoIva()
    {
        return $this->tipoIva;
    }

    /**
     * Set tipoCliente
     *
     * @param \IM\SysTurBundle\Entity\TipoCliente $tipoCliente
     * @return Cliente
     */
    public function setTipoCliente(\IM\SysTurBundle\Entity\TipoCliente $tipoCliente = null)
    {
        $this->tipoCliente = $tipoCliente;

        return $this;
    }

    /**
     * Get tipoCliente
     *
     * @return \IM\SysTurBundle\Entity\TipoCliente 
     */
    public function getTipoCliente()
    {
        return $this->tipoCliente;
    }

    /**
     * Set categoria
     *
     * @param \IM\SysTurBundle\Entity\Categoria $categoria
     * @return Cliente
     */
    public function setCategoria(\IM\SysTurBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \IM\SysTurBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add contactos
     *
     * @param \IM\SysTurBundle\Entity\Contacto $contactos
     * @return Cliente
     */
    public function addContacto(\IM\SysTurBundle\Entity\Contacto $contactos)
    {
        $this->contactos[] = $contactos;

        return $this;
    }

    /**
     * Remove contactos
     *
     * @param \IM\SysTurBundle\Entity\Contacto $contactos
     */
    public function removeContacto(\IM\SysTurBundle\Entity\Contacto $contactos)
    {
        $this->contactos->removeElement($contactos);
    }

    /**
     * Get contactos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactos()
    {
        return $this->contactos;
    }

    /**
     * Add documentos
     *
     * @param \IM\SysTurBundle\Entity\Documento $documentos
     * @return Cliente
     */
    public function addDocumento(\IM\SysTurBundle\Entity\Documento $documentos)
    {
        $this->documentos[] = $documentos;

        return $this;
    }

    /**
     * Remove documentos
     *
     * @param \IM\SysTurBundle\Entity\Documento $documentos
     */
    public function removeDocumento(\IM\SysTurBundle\Entity\Documento $documentos)
    {
        $this->documentos->removeElement($documentos);
    }

    /**
     * Get documentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Cliente
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
     * @return Cliente
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
     * @return Cliente
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
    
    /**
     * To String Method
     */
    public function __toString() {
        return $this->apellido . ', ' . $this->nombres;
    }

    /**
     * Add filesCliente
     *
     * @param \IM\SysTurBundle\Entity\ClienteFile $filesCliente
     * @return Cliente
     */
    public function addFilesCliente(\IM\SysTurBundle\Entity\ClienteFile $filesCliente)
    {
        $this->filesCliente[] = $filesCliente;

        return $this;
    }

    /**
     * Remove filesCliente
     *
     * @param \IM\SysTurBundle\Entity\ClienteFile $filesCliente
     */
    public function removeFilesCliente(\IM\SysTurBundle\Entity\ClienteFile $filesCliente)
    {
        $this->filesCliente->removeElement($filesCliente);
    }

    /**
     * Get filesCliente
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilesCliente()
    {
        return $this->filesCliente;
    }
}
