<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartmentRepository")
 */
class Department
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=3, nullable=false)
     * @ORM\Id
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Salesperson", mappedBy="department")
     */
    private $salesperson;

    public function __construct() {
        $this->salesperson = new ArrayCollection();
    }

    /**
     * @return Collection|Salesperson[]
     */
    public function getSalesperson()
    {
        return $this->salesperson;
    }

    public function addSalesperson(Salesperson $salesperson): self
    {
        if (!$this->salesperson->contains($salesperson)) {
            $this->salesperson[] = $salesperson;
        }

        return $this;
    }

    public function removeSalesperson(Salesperson $salesperson): self
    {
        if ($this->salesperson->contains($salesperson)) {
            $this->salesperson->removeElement($salesperson);
        }

        return $this;
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
