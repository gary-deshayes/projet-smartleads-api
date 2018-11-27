<?php

namespace App\Entity;

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
}
