<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operations
 *
 * @ORM\Table(name="operations")
 * @ORM\Entity
 */
class Operations
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @ORM\Id
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type_operation", type="string", length=255, nullable=true)
     */
    private $typeOperation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="visual_headband", type="string", length=255, nullable=true)
     */
    private $visualHeadband;

    /**
     * @var string|null
     *
     * @ORM\Column(name="visuel_lateral", type="string", length=255, nullable=true)
     */
    private $visuelLateral;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): ?self
    {
         $this->name = $name;

         return $this;
    }


    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTypeOperation(): ?string
    {
        return $this->typeOperation;
    }

    public function setTypeOperation(?string $typeOperation): self
    {
        $this->typeOperation = $typeOperation;

        return $this;
    }

    public function getVisualHeadband(): ?string
    {
        return $this->visualHeadband;
    }

    public function setVisualHeadband(?string $visualHeadband): self
    {
        $this->visualHeadband = $visualHeadband;

        return $this;
    }

    public function getVisuelLateral(): ?string
    {
        return $this->visuelLateral;
    }

    public function setVisuelLateral(?string $visuelLateral): self
    {
        $this->visuelLateral = $visuelLateral;

        return $this;
    }


}
