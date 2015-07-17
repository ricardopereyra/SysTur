<?php

namespace IM\SysTurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parameters
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="IM\SysTurBundle\Entity\ParametersRepository")
 */
class Parameters
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
     * @ORM\Column(name="sys_name", type="string", length=255)
     */
    private $sysName;

    /**
     * @var string
     *
     * @ORM\Column(name="sys_host", type="string", length=255)
     */
    private $sysHost;

    /**
     * @var string
     *
     * @ORM\Column(name="sys_webmail", type="string", length=255)
     */
    private $sysWebmail;

    /**
     * @var string
     *
     * @ORM\Column(name="sys_mailport", type="string", length=255)
     */
    private $sysMailport;

    /**
     * @var string
     *
     * @ORM\Column(name="sys_mailhost", type="string", length=255)
     */
    private $sysMailhost;

    /**
     * @var string
     *
     * @ORM\Column(name="sys_mailenc", type="string", length=255)
     */
    private $sysMailenc;

    /**
     * @var string
     *
     * @ORM\Column(name="sys_mailuser", type="string", length=255)
     */
    private $sysMailuser;

    /**
     * @var string
     *
     * @ORM\Column(name="sys_mailpass", type="string", length=255)
     */
    private $sysMailpass;


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
     * Set sysName
     *
     * @param string $sysName
     * @return Parameters
     */
    public function setSysName($sysName)
    {
        $this->sysName = $sysName;

        return $this;
    }

    /**
     * Get sysName
     *
     * @return string 
     */
    public function getSysName()
    {
        return $this->sysName;
    }

    /**
     * Set sysHost
     *
     * @param string $sysHost
     * @return Parameters
     */
    public function setSysHost($sysHost)
    {
        $this->sysHost = $sysHost;

        return $this;
    }

    /**
     * Get sysHost
     *
     * @return string 
     */
    public function getSysHost()
    {
        return $this->sysHost;
    }

    /**
     * Set sysWebmail
     *
     * @param string $sysWebmail
     * @return Parameters
     */
    public function setSysWebmail($sysWebmail)
    {
        $this->sysWebmail = $sysWebmail;

        return $this;
    }

    /**
     * Get sysWebmail
     *
     * @return string 
     */
    public function getSysWebmail()
    {
        return $this->sysWebmail;
    }

    /**
     * Set sysMailport
     *
     * @param string $sysMailport
     * @return Parameters
     */
    public function setSysMailport($sysMailport)
    {
        $this->sysMailport = $sysMailport;

        return $this;
    }

    /**
     * Get sysMailport
     *
     * @return string 
     */
    public function getSysMailport()
    {
        return $this->sysMailport;
    }

    /**
     * Set sysMailhost
     *
     * @param string $sysMailhost
     * @return Parameters
     */
    public function setSysMailhost($sysMailhost)
    {
        $this->sysMailhost = $sysMailhost;

        return $this;
    }

    /**
     * Get sysMailhost
     *
     * @return string 
     */
    public function getSysMailhost()
    {
        return $this->sysMailhost;
    }

    /**
     * Set sysMailenc
     *
     * @param string $sysMailenc
     * @return Parameters
     */
    public function setSysMailenc($sysMailenc)
    {
        $this->sysMailenc = $sysMailenc;

        return $this;
    }

    /**
     * Get sysMailenc
     *
     * @return string 
     */
    public function getSysMailenc()
    {
        return $this->sysMailenc;
    }

    /**
     * Set sysMailuser
     *
     * @param string $sysMailuser
     * @return Parameters
     */
    public function setSysMailuser($sysMailuser)
    {
        $this->sysMailuser = $sysMailuser;

        return $this;
    }

    /**
     * Get sysMailuser
     *
     * @return string 
     */
    public function getSysMailuser()
    {
        return $this->sysMailuser;
    }

    /**
     * Set sysMailpass
     *
     * @param string $sysMailpass
     * @return Parameters
     */
    public function setSysMailpass($sysMailpass)
    {
        $this->sysMailpass = $sysMailpass;

        return $this;
    }

    /**
     * Get sysMailpass
     *
     * @return string 
     */
    public function getSysMailpass()
    {
        return $this->sysMailpass;
    }
}
