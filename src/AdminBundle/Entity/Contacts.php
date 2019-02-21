<?php

namespace App\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contacts
 *
 * @ORM\Table(name="contacts", indexes={@ORM\Index(name="id_profession", columns={"id_profession"})})
 * @ORM\Entity
 */
class Contacts
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     * @ORM\Id
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255, nullable=false)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=false)
     */
    private $firstName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var string|null
     *
     * @ORM\Column(name="decision_level", type="string", length=1, nullable=true, options={"fixed"=true})
     */
    private $decisionLevel;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birth_date", type="datetime", nullable=true)
     */
    private $birthDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile_phone", type="string", length=10, nullable=true)
     */
    private $mobilePhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=10, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="email_prechecked", type="boolean", nullable=true)
     */
    private $emailPrechecked;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="email_checked", type="boolean", nullable=true)
     */
    private $emailChecked;

    /**
     * @var string|null
     *
     * @ORM\Column(name="linkedin", type="string", length=255, nullable=true)
     */
    private $linkedin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="operation_source", type="string", length=255, nullable=true)
     */
    private $operationSource;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=0, nullable=true)
     */
    private $comment;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="opt_in_newsletter", type="boolean", nullable=true)
     */
    private $optInNewsletter;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="opt_in_offres_commercial", type="boolean", nullable=true)
     */
    private $optInOffresCommercial;

    /**
     * @var \Profession
     *
     * @ORM\ManyToOne(targetEntity="Profession")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_profession", referencedColumnName="id")
     * })
     */
    private $idProfession;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Company", inversedBy="idContact")
     * @ORM\JoinTable(name="work_contacts_companys",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_contact", referencedColumnName="code")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_company", referencedColumnName="code")
     *   }
     * )
     */
    private $idCompany;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCompany = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDecisionLevel(): ?string
    {
        return $this->decisionLevel;
    }

    public function setDecisionLevel(?string $decisionLevel): self
    {
        $this->decisionLevel = $decisionLevel;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(?string $mobilePhone): self
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailPrechecked(): ?bool
    {
        return $this->emailPrechecked;
    }

    public function setEmailPrechecked(?bool $emailPrechecked): self
    {
        $this->emailPrechecked = $emailPrechecked;

        return $this;
    }

    public function getEmailChecked(): ?bool
    {
        return $this->emailChecked;
    }

    public function setEmailChecked(?bool $emailChecked): self
    {
        $this->emailChecked = $emailChecked;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getOperationSource(): ?string
    {
        return $this->operationSource;
    }

    public function setOperationSource(?string $operationSource): self
    {
        $this->operationSource = $operationSource;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getOptInNewsletter(): ?bool
    {
        return $this->optInNewsletter;
    }

    public function setOptInNewsletter(?bool $optInNewsletter): self
    {
        $this->optInNewsletter = $optInNewsletter;

        return $this;
    }

    public function getOptInOffresCommercial(): ?bool
    {
        return $this->optInOffresCommercial;
    }

    public function setOptInOffresCommercial(?bool $optInOffresCommercial): self
    {
        $this->optInOffresCommercial = $optInOffresCommercial;

        return $this;
    }

    public function getIdProfession(): ?Profession
    {
        return $this->idProfession;
    }

    public function setIdProfession(?Profession $idProfession): self
    {
        $this->idProfession = $idProfession;

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
        }

        return $this;
    }

    public function removeIdCompany(Company $idCompany): self
    {
        if ($this->idCompany->contains($idCompany)) {
            $this->idCompany->removeElement($idCompany);
        }

        return $this;
    }

}
