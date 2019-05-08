<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Target
 *
 * @ORM\Table(name="target_operation")
 * @ORM\Entity
 */
class TargetOperation
{
    /**
     * @var \Operations
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Operations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_operation", referencedColumnName="code")
     * })
     */
    private $operation;

    /**
     * @var string
     *
     * @ORM\Column(name="entity", type="string", length=255, nullable=false)
     */
    private $entity;

    /**
     * @var string
     *
     * @ORM\Column(name="parameter", type="string", length=255, nullable=false)
     */
    private $parameter;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;

   



    /**
     * Get the value of value
     *
     * @return  string
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @param  string  $value
     *
     * @return  self
     */ 
    public function setValue(string $value)
    {
        $this->value = $value;

        return $this;
    }

    

    /**
     * Get the value of entity
     *
     * @return  string
     */ 
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set the value of entity
     *
     * @param  string  $entity
     *
     * @return  self
     */ 
    public function setEntity(string $entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get the value of parameter
     *
     * @return  string
     */ 
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Set the value of parameter
     *
     * @param  string  $parameter
     *
     * @return  self
     */ 
    public function setParameter(string $parameter)
    {
        $this->parameter = $parameter;

        return $this;
    }

    /**
     * Get the value of operation
     *
     * @return  \Operations
     */ 
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Set the value of operation
     *
     * @param  \Operations  $operation
     *
     * @return  self
     */ 
    public function setOperation(\Operations $operation)
    {
        $this->operation = $operation;

        return $this;
    }
}
