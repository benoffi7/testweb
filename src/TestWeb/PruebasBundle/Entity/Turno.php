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
	 * @var \TestWeb\PruebasBundle\Entity\Paciente $Paciente
	 *
	 * @ORM\ManyToOne(targetEntity="\TestWeb\PruebasBundle\Entity\Paciente")
	 * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id", nullable=false)
	 */    
    private $Paciente;

   /**
	 * @var \TestWeb\PruebasBundle\Entity\Doctor $Doctor
	 *
	 * @ORM\ManyToOne(targetEntity="\TestWeb\PruebasBundle\Entity\Doctor")
	 * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=false)
	 */   
    private $Doctor;

    /**
     * @var \DateTime $FechaTurno
     *
     * @ORM\Column(name="FechaTurno", type="datetime")
     */
    private $FechaTurno;

    /**
     * @var boolean $Confirmado
     *
     * @ORM\Column(name="Confirmado", type="boolean")
     */
    private $Confirmado;

    /**
     * @var boolean $Realizado
     *
     * @ORM\Column(name="Realizado", type="boolean")
     */
    private $Realizado;


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
        $this->Paciente = $paciente;
    
        return $this;
    }

    /**
	 * Get \TestWeb\PruebasBundle\Entity\Paciente
	 *
	 * @return Paciente
	 */
    public function getPaciente()
    {
        return $this->Paciente;
    }

    /**
	 * Set doctor
	 *
	 * @param \TestWeb\PruebasBundle\Entity\Doctor $doctor
	 * @return Turno
	 */
    public function setDoctor(\TestWeb\PruebasBundle\Entity\Doctor $doctor)
    {
        $this->Doctor = $doctor;
    
        return $this;
    }

    /**
	 * Get \TestWeb\PruebasBundle\Entity\Doctor
	 *
	 * @return Doctor
	 */
    public function getDoctor()
    {
        return $this->Doctor;
    }

    /**
     * Set FechaTurno
     *
     * @param \DateTime $fechaTurno
     * @return Turno
     */
    public function setFechaTurno($fechaTurno)
    {
        $this->FechaTurno = $fechaTurno;
    
        return $this;
    }

    /**
     * Get FechaTurno
     *
     * @return \DateTime 
     */
    public function getFechaTurno()
    {
        return $this->FechaTurno;
    }

    /**
     * Set Confirmado
     *
     * @param boolean $confirmado
     * @return Turno
     */
    public function setConfirmado($confirmado)
    {
        $this->Confirmado = $confirmado;
    
        return $this;
    }

    /**
     * Get Confirmado
     *
     * @return boolean 
     */
    public function getConfirmado()
    {
        return $this->Confirmado;
    }

    /**
     * Set Realizado
     *
     * @param boolean $realizado
     * @return Turno
     */
    public function setRealizado($realizado)
    {
        $this->Realizado = $realizado;
    
        return $this;
    }

    /**
     * Get Realizado
     *
     * @return boolean 
     */
    public function getRealizado()
    {
        return $this->Realizado;
    }
}
