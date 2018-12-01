<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterRepository")
 */
class Parameter
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
    private $name_application;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address_complement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_admin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_receipt_requests;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="parameters")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Operation", inversedBy="parameter", cascade={"persist", "remove"})
     */
    private $operation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ContactJob", inversedBy="parameters")
     */
    private $contactjobs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyActivityArea", inversedBy="parameters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $companyActivityArea;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyCategory", inversedBy="parameters")
     */
    private $companyCategory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyNbEmployees", inversedBy="parameters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $companyNbEmployees;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyTurnover", inversedBy="parameters")
     */
    private $companyTurnover;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompanyLastTurnover", inversedBy="parameters")
     */
    private $companyLastTurnover;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterComportment", inversedBy="parameter")
     */
    private $parameterComportment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterObject", inversedBy="parameters")
     */
    private $parameterObject;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterTarget", inversedBy="parameters")
     */
    private $parameterTarget;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParameterTypeSite", inversedBy="parameters")
     */
    private $parameterTypeSite;

    public function __construct()
    {
        $this->contactjobs = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameApplication(): ?string
    {
        return $this->name_application;
    }

    public function setNameApplication(string $name_application): self
    {
        $this->name_application = $name_application;

        return $this;
    }

    public function getLogoClient(): ?string
    {
        return $this->logo_client;
    }

    public function setLogoClient(string $logo_client): self
    {
        $this->logo_client = $logo_client;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddressComplement(): ?string
    {
        return $this->address_complement;
    }

    public function setAddressComplement(string $address_complement): self
    {
        $this->address_complement = $address_complement;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->email_contact;
    }

    public function setEmailContact(string $email_contact): self
    {
        $this->email_contact = $email_contact;

        return $this;
    }

    public function getEmailAdmin(): ?string
    {
        return $this->email_admin;
    }

    public function setEmailAdmin(string $email_admin): self
    {
        $this->email_admin = $email_admin;

        return $this;
    }

    public function getEmailReceiptRequests(): ?string
    {
        return $this->email_receipt_requests;
    }

    public function setEmailReceiptRequests(string $email_receipt_requests): self
    {
        $this->email_receipt_requests = $email_receipt_requests;

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

    public function getOperation(): ?Operation
    {
        return $this->operation;
    }

    public function setOperation(?Operation $operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * @return Collection|ContactJob[]
     */
    public function getContactjobs(): Collection
    {
        return $this->contactjobs;
    }

    public function addContactjob(ContactJob $contactjob): self
    {
        if (!$this->contactjobs->contains($contactjob)) {
            $this->contactjobs[] = $contactjob;
        }

        return $this;
    }

    public function removeContactjob(ContactJob $contactjob): self
    {
        if ($this->contactjobs->contains($contactjob)) {
            $this->contactjobs->removeElement($contactjob);
        }

        return $this;
    }

    public function getCompanyActivityArea(): ?CompanyActivityArea
    {
        return $this->companyActivityArea;
    }

    public function setCompanyActivityArea(?CompanyActivityArea $companyActivityArea): self
    {
        $this->companyActivityArea = $companyActivityArea;

        return $this;
    }

    public function getCompanyCategory(): ?CompanyCategory
    {
        return $this->companyCategory;
    }

    public function setCompanyCategory(?CompanyCategory $companyCategory): self
    {
        $this->companyCategory = $companyCategory;

        return $this;
    }

    public function getCompanyNbEmployees(): ?CompanyNbEmployees
    {
        return $this->companyNbEmployees;
    }

    public function setCompanyNbEmployees(?CompanyNbEmployees $companyNbEmployees): self
    {
        $this->companyNbEmployees = $companyNbEmployees;

        return $this;
    }

    public function getCompanyTurnover(): ?CompanyTurnover
    {
        return $this->companyTurnover;
    }

    public function setCompanyTurnover(?CompanyTurnover $companyTurnover): self
    {
        $this->companyTurnover = $companyTurnover;

        return $this;
    }

    public function getCompanyLastTurnover(): ?CompanyLastTurnover
    {
        return $this->companyLastTurnover;
    }

    public function setCompanyLastTurnover(?CompanyLastTurnover $companyLastTurnover): self
    {
        $this->companyLastTurnover = $companyLastTurnover;

        return $this;
    }

    public function getParameterComportment(): ?ParameterComportment
    {
        return $this->parameterComportment;
    }

    public function setParameterComportment(?ParameterComportment $parameterComportment): self
    {
        $this->parameterComportment = $parameterComportment;

        return $this;
    }

    public function getParameterObject(): ?ParameterObject
    {
        return $this->parameterObject;
    }

    public function setParameterObject(?ParameterObject $parameterObject): self
    {
        $this->parameterObject = $parameterObject;

        return $this;
    }

    public function getParameterTarget(): ?ParameterTarget
    {
        return $this->parameterTarget;
    }

    public function setParameterTarget(?ParameterTarget $parameterTarget): self
    {
        $this->parameterTarget = $parameterTarget;

        return $this;
    }

    public function getParameterTypeSite(): ?ParameterTypeSite
    {
        return $this->parameterTypeSite;
    }

    public function setParameterTypeSite(?ParameterTypeSite $parameterTypeSite): self
    {
        $this->parameterTypeSite = $parameterTypeSite;

        return $this;
    }

 
}
