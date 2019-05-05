<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\AffectedAreaRepository")
 */
class AffectedArea 
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
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Department", mappedBy="affectedArea", cascade={"persist"},)
     */
    private $departments;

    public function __construct()
    {
        $this->departments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
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
     * @return Collection|Department[]
     */
    public function getDepartments(): Collection
    {
        return $this->departments;
    }

    public function addDepartment(Department $department): self
    {
        dump("je passe la");
        if (!$this->departments->contains($department)) {
            $this->departments[] = $department;
            $department->setAffectedArea($this);
        }

        return $this;
    }

    public function removeDepartment(Department $department): self
    {
        dump("Je remove");
        if ($this->departments->contains($department)) {
            dump("ce départment ", $department);
            $this->departments->removeElement($department);
            // set the owning side to null (unless already changed)
            if ($department->getAffectedArea() === $this) {
                $department->setAffectedArea(null);
            }
        }

        return $this;
    }

    public function removeAllDepartment(){
        $this->departments =  new ArrayCollection();
    }

    public function setAllDepartments($departments){
        $this->departments =  $departments;
    }

    public function __toString()
    {
        return $this->libelle;
    }


}
