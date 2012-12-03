<?php

namespace TestWeb\PruebasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestWeb\PruebasBundle\Entity\Paciente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TestWeb\PruebasBundle\Entity\PacienteRepository")
 */
class Paciente
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
    private $Apellido;

    /**
     * @var string $Nombre
     *
     * @ORM\Column(name="Nombre", type="string", length=255)
     */
    private $Nombre;

    /**
     * @var integer $Dni
     *
     * @ORM\Column(name="Dni", type="integer")
     */
    private $Dni;

    /**
     * @var \Date $FechaNacimiento
     *
     * @ORM\Column(name="FechaNacimiento", type="date")
     */
    private $FechaNacimiento;


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
     * @return Paciente
     */
    public function setApellido($apellido)
    {
        $this->Apellido = $apellido;
    
        return $this;
    }

    /**
     * Get Apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->Apellido;
    }

    /**
     * Set Nombre
     *
     * @param string $nombre
     * @return Paciente
     */
    public function setNombre($nombre)
    {
        $this->Nombre = $nombre;
    
        return $this;
    }

    /**
     * Get Nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set Dni
     *
     * @param integer $dni
     * @return Paciente
     */
    public function setDni($dni)
    {
        $this->Dni = $dni;
    
        return $this;
    }

    /**
     * Get Dni
     *
     * @return integer 
     */
    public function getDni()
    {
        return $this->Dni;
    }

    /**
     * Set FechaNacimiento
     *
     * @param \Date $fechaNacimiento
     * @return Paciente
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->FechaNacimiento = $fechaNacimiento;
    
        return $this;
    }

    /**
     * Get FechaNacimiento
     *
     * @return \Date 
     */
    public function getFechaNacimiento()
    {
        return $this->FechaNacimiento;
    }
    
    
    public function __toString()
    {
    	return  $this->Apellido .' '. $this->Nombre;
    }
    
    
    
}
