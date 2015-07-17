<?php

namespace IM\SysTurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoSeguimiento
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="IM\SysTurBundle\Entity\TipoSeguimientoRepository")
 */
class TipoSeguimiento
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
     * @ORM\OneToMany(targetEntity="Seguimiento", mappedBy="tipo")
     */
    protected $seguimientos;


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
     * @return TipoSeguimiento
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
        $this->seguimientos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add seguimientos
     *
     * @param \IM\SysTurBundle\Entity\Seguimiento $seguimientos
     * @return TipoSeguimiento
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
}
