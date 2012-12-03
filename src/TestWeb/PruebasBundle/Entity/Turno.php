<?php

namespace TestWeb\PruebasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestWeb\PruebasBundle\Entity\Turno
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TestWeb\PruebasBundle\Entity\TurnoRepository")
 */
class Turno
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
	 * @var \TestWeb\PruebasBundle\Entity\Paciente $paciente
	 *
	 * @ORM\ManyToOne(targetEntity="\TestWeb\PruebasBundle\Entity\Paciente")
	 * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id", nullable=false)
	 */    
    private $paciente;

   /**
	 * @var \TestWeb\PruebasBundle\Entity\Doctor $doctor
	 *
	 * @ORM\ManyToOne(targetEntity="\TestWeb\PruebasBundle\Entity\Doctor")
	 * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=false)
	 */   
    private $doctor;

    /**
     * @var \DateTime $fechaTurno
     *
     * @ORM\Column(name="FechaTurno", type="datetime")
     */
    private $fechaTurno;

    /**
     * @var boolean $confirmado
     *
     * @ORM\Column(name="Confirmado", type="boolean")
     */
    private $confirmado;

    /**
     * @var boolean $realizado
     *
     * @ORM\Column(name="Realizado", type="boolean")
     */
    private $realizado;


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
	 * Set paciente
	 *
	 * @param \TestWeb\PruebasBundle\Entity\Paciente $paciente
	 * @return Turno
	 */
    public function setPaciente(\TestWeb\PruebasBundle\Entity\Paciente $paciente)
    {
        $this->paciente = $paciente;
    
        return $this;
    }

    /**
	 * Get \TestWeb\PruebasBundle\Entity\Paciente
	 *
	 * @return Paciente
	 */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
	 * Set doctor
	 *
	 * @param \TestWeb\PruebasBundle\Entity\Doctor $doctor
	 * @return Turno
	 */
    public function setDoctor(\TestWeb\PruebasBundle\Entity\Doctor $doctor)
    {
        $this->doctor = $doctor;
    
        return $this;
    }

    /**
	 * Get \TestWeb\PruebasBundle\Entity\Doctor
	 *
	 * @return Doctor
	 */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * Set FechaTurno
     *
     * @param \DateTime $fechaTurno
     * @return Turno
     */
    public function setFechaTurno($fechaTurno)
    {
        $this->fechaTurno = $fechaTurno;
    
        return $this;
    }

    /**
     * Get FechaTurno
     *
     * @return \DateTime 
     */
    public function getFechaTurno()
    {
        return $this->fechaTurno;
    }

    /**
     * Set Confirmado
     *
     * @param boolean $confirmado
     * @return Turno
     */
    public function setConfirmado($confirmado)
    {
        $this->confirmado = $confirmado;
    
        return $this;
    }

    /**
     * Get Confirmado
     *
     * @return boolean 
     */
    public function getConfirmado()
    {
        return $this->confirmado;
    }

    /**
     * Set Realizado
     *
     * @param boolean $realizado
     * @return Turno
     */
    public function setRealizado($realizado)
    {
        $this->realizado = $realizado;
    
        return $this;
    }

    /**
     * Get Realizado
     *
     * @return boolean 
     */
    public function getRealizado()
    {
        return $this->realizado;
    }
}
