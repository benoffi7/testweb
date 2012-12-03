<?php

namespace TestWeb\PruebasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestWeb\PruebasBundle\Entity\Doctor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TestWeb\PruebasBundle\Entity\DoctorRepository")
 */
class Doctor
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $Apellido
     *
     * @ORM\Column(name="Apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var string $Nombre
     *
     * @ORM\Column(name="Nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var integer $Dni
     *
     * @ORM\Column(name="Dni", type="integer")
     */
    private $dni;

    /**
     * @var \Date $FechaNacimiento
     *
     * @ORM\Column(name="FechaNacimiento", type="date")
     */
    private $fechaNacimiento;


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
     * Set Apellido
     *
     * @param string $apellido
     * @return Doctor
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    
        return $this;
    }

    /**
     * Get Apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set Nombre
     *
     * @param string $nombre
     * @return Doctor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get Nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set Dni
     *
     * @param integer $dni
     * @return Doctor
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    
        return $this;
    }

    /**
     * Get Dni
     *
     * @return integer 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set FechaNacimiento
     *
     * @param \Date $fechaNacimiento
     * @return Doctor
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    
        return $this;
    }

    /**
     * Get FechaNacimiento
     *
     * @return \Date
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }
    
    public function __toString()
    {
    	return  $this->apellido .' '. $this->nombre;
    }
}
