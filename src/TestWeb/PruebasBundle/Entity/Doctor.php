<?php

namespace TestWeb\PruebasBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * TestWeb\PruebasBundle\Entity\Doctor
 *
 * @ORM\Table()
 * @UniqueEntity(fields="dni", message="DNI en uso.")
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
     * @Assert\NotBlank()
     * @ORM\Column(name="Apellido", type="string", length=255, nullable=false)
     */
    private $apellido;

    /**
     * @var string $Nombre
     * @Assert\NotBlank()
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=false)
     */
    private $nombre;
    
  /**
	 * @var \TestWeb\PruebasBundle\Entity\Especialidad $especialidad
	 * @Assert\NotBlank()
	 * @ORM\ManytoOne(targetEntity="\TestWeb\PruebasBundle\Entity\Especialidad")
	 * @ORM\JoinColumn(name="especialidad_id", referencedColumnName="id", nullable=false)
	 */    
    private $especialidad;
    
    /**
     * @var integer $Dni
     * @Assert\NotBlank()
     * @ORM\Column(name="Dni", type="integer", nullable=false, unique = true)
     */
    private $dni;

    /**
     * @var \Date $FechaNacimiento
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
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
	 * Set especialidad
	 *
	 * @param \TestWeb\PruebasBundle\Entity\Especialidad $especialidad
	 * @return Doctor
	 */
    public function setEspecialidad(\TestWeb\PruebasBundle\Entity\Especialidad $especialidad)
    {
        $this->especialidad = $especialidad;    
        return $this;
    }

    /**
	 * Get \TestWeb\PruebasBundle\Entity\Especialidad
	 *
	 * @return Especialidad
	 */
    public function getEspecialidad()
    {
        return $this->especialidad;
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
