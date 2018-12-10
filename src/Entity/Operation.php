<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert;

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
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 100,
     *      minMessage = "Le nom de l'opération doit au moins contenir un caractère",
     *      maxMessage = "La limite des 100 caractères a été dépassée pour le nom de l'opération"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'url de l'opération ne doit pas dépasser 255 caractères"
     * )
     */
    private $URL;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'header de l'opération ne doit pas contenir plus de 255 caractères"
     * )
     */
    private $VisualHeader;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le létaral de l'opération ne doit pas contenir plus de 255 caractères"
     * )
     */
    private $VisualLateral;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OperationParticipation", mappedBy="idOperation")
     */
    private $Participations;

    public function __construct()
    {
        $this->operationParticipations = new ArrayCollection();
        $this->Participations = new ArrayCollection();
    }
  
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OperationTypeOperation", inversedBy="operations")
     * @Assert\NotBlank
     */
    private $idTypeOperation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="operations")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Blank
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Parameter", mappedBy="operation", cascade={"persist", "remove"})
     * @Assert\NotBlank
     */
    private $parameter;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getParameter(): ?Parameter
    {
        return $this->parameter;
    }

    public function setParameter(?Parameter $parameter): self
    {
        $this->parameter = $parameter;

        // set (or unset) the owning side of the relation if necessary
        $newOperation = $parameter === null ? null : $this;
        if ($newOperation !== $parameter->getOperation()) {
            $parameter->setOperation($newOperation);
        }

        return $this;
    }
}
