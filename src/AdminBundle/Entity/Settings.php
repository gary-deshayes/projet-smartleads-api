<?php

namespace App\AdminBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity
 */
class Settings
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="application_name", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le nom de l'application doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le nom de l'application ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $applicationName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="application_logo", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "L'url du logo doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "L'url du logo de l'application ne doit pas dépasser {{ limit }} caractères."
     * )
     * 
     */
    private $applicationLogo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "L'adresse de l'application doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "L'adresse de l'application ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="additional_address", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le supplément d'adresse doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le supplément d'adresse ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $additionalAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=10, nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="Veuillez ne saisir que des numéros."
     * )
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez saisir le numéro en 0X-XX-XX-XX-XX",
     *      maxMessage = "Veuillez saisir le numéro en 0X-XX-XX-XX-XX",
     *      exactMessage = "Veuillez saisir uniquement des numéros (format :0X-XX-XX-XX-XX)"
     * )
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fax", type="string", length=10, nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="Veuillez ne saisir que des numéros."
     * )
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez saisir le numéro en 0X-XX-XX-XX-XX",
     *      maxMessage = "Veuillez saisir le numéro en 0X-XX-XX-XX-XX",
     *      exactMessage = "Veuillez saisir uniquement des numéros (format :0X-XX-XX-XX-XX)"
     * )
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide."
     *     
     * )
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'email ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email_admin", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'email ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $emailAdmin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email_contact", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'email ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $emailContact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApplicationName(): ?string
    {
        return $this->applicationName;
    }

    public function setApplicationName(?string $applicationName): self
    {
        $this->applicationName = $applicationName;

        return $this;
    }

    public function getApplicationLogo(): ?string
    {
        return $this->applicationLogo;
    }

    public function setApplicationLogo(?string $applicationLogo): self
    {
        $this->applicationLogo = $applicationLogo;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAdditionalAddress(): ?string
    {
        return $this->additionalAddress;
    }

    public function setAdditionalAddress(?string $additionalAddress): self
    {
        $this->additionalAddress = $additionalAddress;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailAdmin(): ?string
    {
        return $this->emailAdmin;
    }

    public function setEmailAdmin(?string $emailAdmin): self
    {
        $this->emailAdmin = $emailAdmin;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(?string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }


}
