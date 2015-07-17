<?php

namespace IM\SysTurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="IM\SysTurBundle\Entity\FileRepository")
 */
class File
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="partida", type="date")
     */
    private $partida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="retorno", type="date")
     */
    private $retorno;

    /**
     * @ORM\ManyToOne(targetEntity="Destino", inversedBy="files")
     * @ORM\JoinColumn(name="destino", referencedColumnName="id")
     */
    private $destino;

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
     * @ORM\OneToMany(targetEntity="Seguimiento", mappedBy="file")
     */
    protected $seguimientos;

    /**
     * @ORM\OneToMany(targetEntity="ClienteFile", mappedBy="file")
     */
    protected $clientesFile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->seguimientos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clientesFile = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set partida
     *
     * @param \DateTime $partida
     * @return File
     */
    public function setPartida($partida)
    {
        $this->partida = $partida;

        return $this;
    }

    /**
     * Get partida
     *
     * @return \DateTime 
     */
    public function getPartida()
    {
        return $this->partida;
    }

    /**
     * Set retorno
     *
     * @param \DateTime $retorno
     * @return File
     */
    public function setRetorno($retorno)
    {
        $this->retorno = $retorno;

        return $this;
    }

    /**
     * Get retorno
     *
     * @return \DateTime 
     */
    public function getRetorno()
    {
        return $this->retorno;
    }

    /**
     * Set destino
     *
     * @param integer $destino
     * @return File
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return integer 
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return File
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
     * @return File
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
     * @return File
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
     * Add seguimientos
     *
     * @param \IM\SysTurBundle\Entity\Seguimiento $seguimientos
     * @return File
     */
    public function addSeguimiento(\IM\SysTurBundle\Entity\Seguimiento $seguimientos)
    {
        $this->seguimientos[] = $seguimientos;

        return $this;
    }

    /**
     * Remove seguimientos
     *
     * @param \IM\SysTurBundle\Entity\Seguimiento $seguimientos
     */
    public function removeSeguimiento(\IM\SysTurBundle\Entity\Seguimiento $seguimientos)
    {
        $this->seguimientos->removeElement($seguimientos);
    }

    /**
     * Get seguimientos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSeguimientos()
    {
        return $this->seguimientos;
    }

    /**
     * Add clientesFile
     *
     * @param \IM\SysTurBundle\Entity\ClienteFile $clientesFile
     * @return File
     */
    public function addClientesFile(\IM\SysTurBundle\Entity\ClienteFile $clientesFile)
    {
        $this->clientesFile[] = $clientesFile;

        return $this;
    }

    /**
     * Remove clientesFile
     *
     * @param \IM\SysTurBundle\Entity\ClienteFile $clientesFile
     */
    public function removeClientesFile(\IM\SysTurBundle\Entity\ClienteFile $clientesFile)
    {
        $this->clientesFile->removeElement($clientesFile);
    }

    /**
     * Get clientesFile
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientesFile()
    {
        return $this->clientesFile;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return File
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}
