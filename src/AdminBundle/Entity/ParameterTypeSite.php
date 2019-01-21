<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterTypeSiteRepository")
 */
class ParameterTypeSite
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
     * @Groups({"Light"})
     * @MaxDepth(1)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Company", mappedBy="parameterTypeSite")
     */
    private $companies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parameter", mappedBy="parameterTypeSite")
     */
    private $parameters;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
        $this->parameters = new ArrayCollection();
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
            $company->setParameterTypeSite($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            // set the owning side to null (unless already changed)
            if ($company->getParameterTypeSite() === $this) {
                $company->setParameterTypeSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Parameter[]
     */
    public function getParameters(): Collection
    {
        return $this->parameters;
    }

    public function addParameter(Parameter $parameter): self
    {
        if (!$this->parameters->contains($parameter)) {
            $this->parameters[] = $parameter;
            $parameter->setParameterTypeSite($this);
        }

        return $this;
    }

    public function removeParameter(Parameter $parameter): self
    {
        if ($this->parameters->contains($parameter)) {
            $this->parameters->removeElement($parameter);
            // set the owning side to null (unless already changed)
            if ($parameter->getParameterTypeSite() === $this) {
                $parameter->setParameterTypeSite(null);
            }
        }

        return $this;
    }
}
