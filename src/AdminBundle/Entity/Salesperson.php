<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Entity\Operations;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;

/**
 * Salesperson
 *
 * @ORM\Table(name="salesperson", indexes={@ORM\Index(name="id_leader", columns={"id_leader"})})
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\SalespersonRepository")
 * @UniqueEntity("email", message="Cet email existe déjà dans la base de données, veuillez en saisir un autre.")
 * @Vich\Uploadable
 * @UniqueEntity("code", message="Le code existe déjà")
 */
class Salesperson implements UserInterface, JWTUserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "Le code ne doit pas dépasser {{ limit }} caractères."
     * )
     * @ORM\Id
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *      message = "Cette valeur ne doit pas être vide."
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le genre doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le genre ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *      message = "Cette valeur ne doit pas être vide."
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le nom de famille doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le nom de famille ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *      message = "Cette valeur ne doit pas être vide."
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le nom de famille doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le nom de famille ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="profile", type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *      message = "Cette valeur ne doit pas être vide."
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le nom de famille doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le nom de famille ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $profile;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="arrival_date", type="datetime", nullable=true)
     */
    private $arrivalDate;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="departure_date", type="datetime", nullable=true)
     */
    private $departureDate;


    /**
     * @var bool|null
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     * @Assert\Type("boolean")
     */
    private $status;

    /**
     * @var \DateTime|null
     * @Assert\DateTime
     * @ORM\Column(name="birth_date", type="datetime", nullable=true)
     */
    private $birthDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="work_name", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le poste doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le poste ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $workName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile_phone", type="string", length=10, nullable=true)
     * @Assert\Regex(
     *      pattern="/^[0-9]*$/", 
     *      message="Seulement les nombres sont autorisés") 
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez saisir le numéro en 0612345678",
     *      maxMessage = "Veuillez saisir le numéro en 0612345678",
     *      exactMessage = "Le numéro de téléphone doit être à ce format 0XXXXXXXXX"
     * )
     */
    private $mobilePhone;

    /**
     * @var string|null
     * @ORM\Column(name="phone", type="string", length=10, nullable=true)
     * @Assert\Regex(
     *      pattern="/^[0-9]*$/", 
     *      message="Seulement les nombres sont autorisés") 
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez saisir le numéro en 0612345678",
     *      maxMessage = "Veuillez saisir le numéro en 0612345678",
     *      exactMessage = "Le numéro de téléphone doit être à ce format 0XXXXXXXXX"
     * )
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'email ne doit pas dépasser {{ limit }} caractères."
     * )
     * @Assert\Email
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="linkedin", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'url linkedin ne doit pas dépasser {{ limit }} caractères."
     * )
     */

    private $linkedin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'url facebook ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $facebook;

    /**
     * @var string|null
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'url twitter ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $twitter;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="salespersons_image", fileNameProperty="picture")
     * @Assert\Image(
     *     mimeTypes = {"image/png", "image/jpeg", "image/gif"}
     * )
     * @var File
     */
    private $imageFile;

    /**
     * @var string|null
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *     minMessage = "L'image doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "L'image ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $picture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=0, nullable=true)
     */
    private $comment;

    /**
     * @var \AffectedArea
     *
     * @ORM\ManyToOne(targetEntity="AffectedArea")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_affectedArea", referencedColumnName="id")
     * })
     */
    private $affectedArea;

    /**
     * @var \Salesperson
     *
     * @ORM\ManyToOne(targetEntity="Salesperson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_leader", referencedColumnName="code")
     * })
     */
    private $idLeader;

    // Ajout pour User

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * 
     */
    private $password;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $tokenResetPassword;

    /**
     * Un commercial a plusieurs contacts
     * @OneToMany(targetEntity="Contacts", mappedBy="code")
     */
    private $contacts;

    /**
     * Liste des opérations du commercial
     * @OneToMany(targetEntity="Operations", mappedBy="code")
     */
    private $operations;

    /**
     * @var \Salesperson
     *
     * @ORM\ManyToOne(targetEntity="Salesperson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_last_update", referencedColumnName="code")
     * })
     */
    private $user_last_update;


    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->operations = new ArrayCollection();
    }


    /**
     * @return Collection|Operations[]
     */
    public function getOperations()
    {
        return $this->operations;
    }

    public function addOperation(Operations $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations[] = $operation;
            $operations->addIdCompany($this);
        }

        return $this;
    }

    public function removeOperation(Operations $operation): self
    {
        if ($this->operation->contains($operation)) {
            $this->operation->removeElement($operation);
            $operation->removeIdCompany($this);
        }

        return $this;
    }

    /**
     * @return Collection|Contacts[]
     */
    public function getIdContact()
    {
        return $this->contacts;
    }

    public function addIdContact(Contacts $idContact): self
    {
        if (!$this->contacts->contains($idContact)) {
            $this->contacts[] = $idContact;
            $contacts->addIdCompany($this);
        }

        return $this;
    }

    public function removeIdContact(Contacts $idContact): self
    {
        if ($this->contacts->contains($idContact)) {
            $this->contacts->removeElement($idContact);
            $contacts->removeIdCompany($this);
        }

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getTokenResetPassword(): string
    {
        return (string)$this->tokenResetPassword;
    }

    public function setTokenResetPassword(string $tokenResetPassword): self
    {
        $this->tokenResetPassword = $tokenResetPassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getAge()
    {
        return $this->birthDate->diff(new \DateTime)->format("%Y");
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

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

    public function getProfile(): ?string
    {
        return $this->profile;
    }

    public function setProfile(string $profile): self
    {
        $this->profile = $profile;

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

    public function getDepartureDate(): ?\DateTime
    {
        return $this->departureDate;
    }

    public function setDepartureDate(?\DateTime $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getArrivalDate(): ?\DateTime
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(?\DateTime $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

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

    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTime $birthDate): self
    {
        $this->birthDate = $birthDate;

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

    public function getWorkName(): ?string
    {
        return $this->workName;
    }

    public function setWorkName(?string $workName): self
    {
        $this->workName = $workName;

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

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

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

    public function getLeader(): ?self
    {
        return $this->idLeader;
    }

    public function setLeader(?self $idLeader): self
    {
        $this->idLeader = $idLeader;

        return $this;
    }

    public function __toString()
    {
        return $this->lastName . " " . $this->firstName;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imageFile instanceof UploadedFile) {

            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getAffectedArea()
    {
        return $this->affectedArea;
    }

    public function setAffectedArea($affectedArea)
    {
        $this->affectedArea = $affectedArea;

        return $this;
    }

    public function getRolesFormat()
    {
        $role = "";
        switch ($this->roles[0]) {
            case 'ROLE_COMMERCIAL':
                $role = "Commercial";
                break;
            case 'ROLE_RESPONSABLE':
                $role = "Responsable commercial";
                break;
            case 'ROLE_DIRECTEUR':
                $role = "Directeur commercial";
                break;
        }
        return $role;
    }

    public function getIdLeader(): ?self
    {
        return $this->idLeader;
    }

    public function setIdLeader(?self $idLeader): self
    {
        $this->idLeader = $idLeader;

        return $this;
    }

    /**
     * @return Collection|Contacts[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contacts $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setCode($this);
        }

        return $this;
    }

    public function removeContact(Contacts $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getCode() === $this) {
                $contact->setCode(null);
            }
        }

        return $this;
    }



    /**
     * Get the value of user_last_update
     *
     * @return  \Salesperson
     */
    public function getUser_last_update()
    {
        return $this->user_last_update;
    }

    /**
     * Set the value of user_last_update
     *
     * @param  \Salesperson  $user_last_update
     *
     * @return  self
     */
    public function setUser_last_update(Salesperson $user_last_update)
    {
        $this->user_last_update = $user_last_update;

        return $this;
    }

    public function getNumberCompaniesAffected()
    {
        $companies = array();
        foreach ($this->contacts as $contact) {
            if ($contact->getCompany() != null) {
                array_push($companies, $contact->getCompany());
            }
        }
        return count($companies);
    }

    public function getNumberContactsAffected()
    {
        return count($this->contacts);
    }

    /**
     * Creates a new instance from a given JWT payload.
     *
     * @param string $username
     * @param array  $payload
     *
     * @return JWTUserInterface
     */
    public static function createFromPayload($username, array $payload){

    }

    
}
