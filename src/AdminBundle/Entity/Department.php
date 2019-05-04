<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\DepartmentRepository")
 */
class Department
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
     * @ORM\Column(type="string", length=2)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\AffectedArea", inversedBy="departments")
     * @JoinColumn(name="affected_area_id", referencedColumnName="id")
     */
    private $affectedArea;

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

    public function __toString(){
        return $this->libelle;
    }

    public function getAffectedArea(): ?AffectedArea
    {
        return $this->affectedArea;
    }

    public function setAffectedArea(?AffectedArea $affectedArea): self
    {
        $this->affectedArea = $affectedArea;

        return $this;
    }

}
