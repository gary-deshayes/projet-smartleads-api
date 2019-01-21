<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\ParameterComportmentRepository")
 */
class ParameterComportment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max = 255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Parameter", mappedBy="parameterComportment")
     */
    private $parameter;

    /**
     * @ORM\OneToMany(targetEntity="App\AdminBundle\Entity\Company", mappedBy="parameterComportment")
     */
    private $companies;

    public function __construct()
    {
        $this->parameter = new ArrayCollection();
        $this->companies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Parameter[]
     */
    public function getParameter(): Collection
    {
        return $this->parameter;
    }

    public function addParameter(Parameter $parameter): self
    {
        if (!$this->parameter->contains($parameter)) {
            $this->parameter[] = $parameter;
            $parameter->setParameterComportment($this);
        }

        return $this;
    }

    public function removeParameter(Parameter $parameter): self
    {
        if ($this->parameter->contains($parameter)) {
            $this->parameter->removeElement($parameter);
            // set the owning side to null (unless already changed)
            if ($parameter->getParameterComportment() === $this) {
                $parameter->setParameterComportment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Company[]
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->setParameterComportment($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            // set the owning side to null (unless already changed)
            if ($company->getParameterComportment() === $this) {
                $company->setParameterComportment(null);
            }
        }

        return $this;
    }
}
