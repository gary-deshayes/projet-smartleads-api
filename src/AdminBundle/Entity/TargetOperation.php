<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\AdminBundle\Entity\Operations;

/**
 * Target
 *
 * @ORM\Table(name="target_operation")
 * @ORM\Entity
 */
class TargetOperation
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @var \Operations
     *
     * @ORM\ManyToOne(targetEntity="Operations")
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
     * @var int
     *
     * @ORM\Column(name="send", type="integer", length=1,  nullable=false)
     */
    private $send;

    /**
     * @var int
     *
     * @ORM\Column(name="type_value", type="integer", length=1,  nullable=false)
     */
    private $type_value;
   
    /**
     * @var string|NULL
     *
     * @ORM\Column(name="value_entity", type="string", length=255,  nullable=true)
     */
    private $value_entity;



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
    public function setOperation(Operations $operation)
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Get the value of send
     *
     * @return  int
     */ 
    public function getSend()
    {
        return $this->send;
    }

    /**
     * Set the value of send
     *
     * @param  int  $send
     *
     * @return  self
     */ 
    public function setSend(int $send)
    {
        $this->send = $send;

        return $this;
    }

    /**
     * Get the value of type_value
     *
     * @return  int
     */ 
    public function getType_value()
    {
        return $this->type_value;
    }

    /**
     * Set the value of type_value
     *
     * @param  int  $type_value
     *
     * @return  self
     */ 
    public function setType_value(int $type_value)
    {
        $this->type_value = $type_value;

        return $this;
    }

    /**
     * Get the value of value_entity
     *
     * @return  string|NULL
     */ 
    public function getValue_entity()
    {
        return $this->value_entity;
    }

    /**
     * Set the value of value_entity
     *
     * @param  string $value_entity
     *
     * @return  self
     */ 
    public function setValue_entity($value_entity)
    {
        $this->value_entity = $value_entity;

        return $this;
    }
}
