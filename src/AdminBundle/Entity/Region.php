<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Region
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Salesperson", mappedBy="region")
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

    public function getCodes(): ?string
    {
        return $this->codes;
    }

    public function setCodes(string $codes): self
    {
        $this->codes = $codes;

        return $this;
    }
}
