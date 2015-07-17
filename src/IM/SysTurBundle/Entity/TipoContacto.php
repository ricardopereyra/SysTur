<?php

namespace IM\SysTurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoContacto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TipoContacto
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
     * @ORM\OneToMany(targetEntity="Contacto", mappedBy="tipoContacto")
     */
    protected $contactos;


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
     * @return TipoContacto
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
        $this->contactos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contactos
     *
     * @param \IM\SysTurBundle\Entity\Contacto $contactos
     * @return TipoContacto
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
     * ToString Method
     */
    public function __toString() {
        return $this->nombre;
    }
}
