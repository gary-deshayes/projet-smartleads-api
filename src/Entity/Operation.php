<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToMany(targetEntity="App\Entity\OperationParticipation", mappedBy="idOperation")
     */
    private $operationParticipations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OperationParticipation", mappedBy="idOperation")
     */
    private $Participations;

    public function __construct()
    {
        $this->operationParticipations = new ArrayCollection();
        $this->Participations = new ArrayCollection();
    }

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

    /**
     * @return Collection|OperationParticipation[]
     */
    public function getOperationParticipations(): Collection
    {
        return $this->operationParticipations;
    }

    public function addOperationParticipation(OperationParticipation $operationParticipation): self
    {
        if (!$this->operationParticipations->contains($operationParticipation)) {
            $this->operationParticipations[] = $operationParticipation;
            $operationParticipation->addIdOperation($this);
        }

        return $this;
    }

    public function removeOperationParticipation(OperationParticipation $operationParticipation): self
    {
        if ($this->operationParticipations->contains($operationParticipation)) {
            $this->operationParticipations->removeElement($operationParticipation);
            $operationParticipation->removeIdOperation($this);
        }

        return $this;
    }

    /**
     * @return Collection|OperationParticipation[]
     */
    public function getParticipations(): Collection
    {
        return $this->Participations;
    }

    public function addParticipation(OperationParticipation $participation): self
    {
        if (!$this->Participations->contains($participation)) {
            $this->Participations[] = $participation;
            $participation->setIdOperation($this);
        }

        return $this;
    }

    public function removeParticipation(OperationParticipation $participation): self
    {
        if ($this->Participations->contains($participation)) {
            $this->Participations->removeElement($participation);
            // set the owning side to null (unless already changed)
            if ($participation->getIdOperation() === $this) {
                $participation->setIdOperation(null);
            }
        }

        return $this;
    }
}
