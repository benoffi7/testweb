<?php

namespace TestWeb\PruebasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestWeb\PruebasBundle\Entity\Especialidad
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TestWeb\PruebasBundle\Entity\EspecialidadRepository")
 */
class Especialidad
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
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;


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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Especialidad
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    public function __toString()
    {
    	return $this->descripcion;
    }
}
