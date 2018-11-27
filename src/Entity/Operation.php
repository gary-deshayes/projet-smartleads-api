<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OperationRepository")
 */
class Operation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $URL;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $VisualHeader;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $VisualLateral;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OperationTypeOperation", inversedBy="operations")
     */
    private $idTypeOperation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getURL(): ?string
    {
        return $this->URL;
    }

    public function setURL(?string $URL): self
    {
        $this->URL = $URL;

        return $this;
    }

    public function getVisualHeader(): ?string
    {
        return $this->VisualHeader;
    }

    public function setVisualHeader(?string $VisualHeader): self
    {
        $this->VisualHeader = $VisualHeader;

        return $this;
    }

    public function getVisualLateral(): ?string
    {
        return $this->VisualLateral;
    }

    public function setVisualLateral(?string $VisualLateral): self
    {
        $this->VisualLateral = $VisualLateral;

        return $this;
    }

    public function getIdTypeOperation(): ?OperationTypeOperation
    {
        return $this->idTypeOperation;
    }

    public function setIdTypeOperation(?OperationTypeOperation $idTypeOperation): self
    {
        $this->idTypeOperation = $idTypeOperation;

        return $this;
    }
}
