<?php

namespace IM\SysTurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Categoria
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
     * @ORM\OneToMany(targetEntity="Cliente", mappedBy="categoria")
     */
    protected $clientes;


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
     * Set nombre
     *
     * @param string $nombre
     * @return Categoria
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clientes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add clientes
     *
     * @param \IM\SysTurBundle\Entity\Cliente $clientes
     * @return Categoria
     */
    public function addCliente(\IM\SysTurBundle\Entity\Cliente $clientes)
    {
        $this->clientes[] = $clientes;

        return $this;
    }

    /**
     * Remove clientes
     *
     * @param \IM\SysTurBundle\Entity\Cliente $clientes
     */
    public function removeCliente(\IM\SysTurBundle\Entity\Cliente $clientes)
    {
        $this->clientes->removeElement($clientes);
    }

    /**
     * Get clientes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientes()
    {
        return $this->clientes;
    }
    
    /**
     * To String Method
     */
    public function __toString() {
        return $this->nombre;
    }
}
