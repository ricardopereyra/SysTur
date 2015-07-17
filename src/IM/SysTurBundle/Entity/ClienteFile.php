<?php

namespace IM\SysTurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClienteFile
 *
 * @ORM\Table(name="ClienteFile", uniqueConstraints={@ORM\UniqueConstraint(name="file", columns={"file", "cliente"})})
 * @ORM\Entity(repositoryClass="IM\SysTurBundle\Entity\ClienteFileRepository")
 */
class ClienteFile
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
     * @var integer
     *
     * @ORM\Column(name="propietario", type="integer", nullable=true)
     */
    private $propietario;


    /**
     * @ORM\ManyToOne(targetEntity="File", inversedBy="clientesFile")
     * @ORM\JoinColumn(name="file", referencedColumnName="id")
     */
    protected $file;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="filesCliente")
     * @ORM\JoinColumn(name="cliente", referencedColumnName="id")
     */
    protected $cliente;

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
     * Set propietario
     *
     * @param integer $propietario
     * @return ClienteFile
     */
    public function setPropietario($propietario)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * Get propietario
     *
     * @return integer 
     */
    public function getPropietario()
    {
        return $this->propietario;
    }

    /**
     * Set file
     *
     * @param \IM\SysTurBundle\Entity\File $file
     * @return ClienteFile
     */
    public function setFile(\IM\SysTurBundle\Entity\File $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \IM\SysTurBundle\Entity\File 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set cliente
     *
     * @param \IM\SysTurBundle\Entity\Cliente $cliente
     * @return ClienteFile
     */
    public function setCliente(\IM\SysTurBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \IM\SysTurBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->propietario = 0;
    }
}
