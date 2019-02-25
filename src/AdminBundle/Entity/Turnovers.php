<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Turnovers
 *
 * @ORM\Table(name="turnovers")
 * @ORM\Entity
 */
class Turnovers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=false)
     */
    private $libelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Company", mappedBy="idTurnovers")
     */
    private $idCompany;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCompany = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Company[]
     */
    public function getIdCompany(): Collection
    {
        return $this->idCompany;
    }

    public function addIdCompany(Company $idCompany): self
    {
        if (!$this->idCompany->contains($idCompany)) {
            $this->idCompany[] = $idCompany;
            $idCompany->addIdTurnover($this);
        }

        return $this;
    }

    public function removeIdCompany(Company $idCompany): self
    {
        if ($this->idCompany->contains($idCompany)) {
            $this->idCompany->removeElement($idCompany);
            $idCompany->removeIdTurnover($this);
        }

        return $this;
    }

}
