<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 */
class Company
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
    private $company_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at_plug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $update_at_plug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $leader_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coutry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress_complement;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adress_commentary;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siret_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $naf_code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $source;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyCode(): ?string
    {
        return $this->company_code;
    }

    public function setCompanyCode(string $company_code): self
    {
        $this->company_code = $company_code;

        return $this;
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

    public function getCreatedAtPlug(): ?\DateTimeInterface
    {
        return $this->created_at_plug;
    }

    public function setCreatedAtPlug(\DateTimeInterface $created_at_plug): self
    {
        $this->created_at_plug = $created_at_plug;

        return $this;
    }

    public function getUpdateAtPlug(): ?\DateTimeInterface
    {
        return $this->update_at_plug;
    }

    public function setUpdateAtPlug(\DateTimeInterface $update_at_plug): self
    {
        $this->update_at_plug = $update_at_plug;

        return $this;
    }

    public function getLeaderCode(): ?string
    {
        return $this->leader_code;
    }

    public function setLeaderCode(?string $leader_code): self
    {
        $this->leader_code = $leader_code;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(?string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }

    public function getCoutry(): ?string
    {
        return $this->coutry;
    }

    public function setCoutry(?string $coutry): self
    {
        $this->coutry = $coutry;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getAdressComplement(): ?string
    {
        return $this->adress_complement;
    }

    public function setAdressComplement(?string $adress_complement): self
    {
        $this->adress_complement = $adress_complement;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(?string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

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

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getAdressCommentary(): ?string
    {
        return $this->adress_commentary;
    }

    public function setAdressCommentary(?string $adress_commentary): self
    {
        $this->adress_commentary = $adress_commentary;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getSiretNumber(): ?string
    {
        return $this->siret_number;
    }

    public function setSiretNumber(string $siret_number): self
    {
        $this->siret_number = $siret_number;

        return $this;
    }

    public function getNafCode(): ?string
    {
        return $this->naf_code;
    }

    public function setNafCode(?string $naf_code): self
    {
        $this->naf_code = $naf_code;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }
}
