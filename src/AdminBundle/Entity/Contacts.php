<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use App\AdminBundle\Entity\Salesperson;
use App\AdminBundle\Entity\DecisionMaking;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Contacts
 *
 * @ORM\Table(name="contacts", indexes={@ORM\Index(name="id_profession", columns={"id_profession"})})
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\ContactsRepository")
 * @UniqueEntity("code", message="Le code existe déjà")
 * @UniqueEntity("email", message="Cet email existe déjà dans la base de données, veuillez en saisir un autre.")
 * @Vich\Uploadable
 */
class Contacts
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "Le code ne doit pas dépasser {{ limit }} caractères."
     * )
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
     * @ORM\Column(name="first_name", type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *      message = "Cette valeur ne doit pas être vide."
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le prénom doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le prénom ne doit pas dépasser {{ limit }} caractères."
     * )
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
     * @ManyToOne(targetEntity="DecisionMaking")
     * @JoinColumn(name="decision_making", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $decision_making;

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
     * @Assert\Regex(
     *      pattern="/^[0-9]*$/", 
     *      message="Seulement les nombres sont autorisés") 
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez saisir le numéro en 0612345678",
     *      maxMessage = "Veuillez saisir le numéro en 0612345678",
     *      exactMessage = "Le numéro de fax doit contenir 10 chiffres"
     * )
     */
    private $mobilePhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=10, nullable=true)
     * @Assert\Regex(
     *      pattern="/^[0-9]*$/", 
     *      message="Seulement les nombres sont autorisés") 
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez saisir le numéro en 0612345678",
     *      maxMessage = "Veuillez saisir le numéro en 0612345678",
     *      exactMessage = "Le numéro de fax doit contenir 10 chiffres"
     * )
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="standard_phone", type="string", length=10, nullable=true)
     * @Assert\Regex(
     *      pattern="/^[0-9]*$/", 
     *      message="Seulement les nombres sont autorisés") 
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez saisir le numéro en 0612345678",
     *      maxMessage = "Veuillez saisir le numéro en 0612345678"
     * )
     */
    private $standardPhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true, unique=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'email ne doit pas dépasser {{ limit }} caractères."
     * )
     * @Assert\Email
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
     * @ORM\Column(name="work_name", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le nom du poste ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $workName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="linkedin", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le lien LinkedIn ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $linkedin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le lien Facebook ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $facebook;

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
     * @var string|null
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le lien twitter ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $twitter;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="contacts_image", fileNameProperty="picture")
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
     *   @ORM\JoinColumn(name="id_profession", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $profession;

    /**
     * @var \Salesperson
     *
     * @ORM\ManyToOne(targetEntity="Salesperson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_last_update", referencedColumnName="code")
     * })
     */
    private $user_last_update;

    /**
     * @var \Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="contacts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_company", referencedColumnName="code", onDelete="SET NULL")
     * })
     */
    private $company;

    /**
     * @var \Salesperson
     * Un contact n'a qu'un seul commercial
     * @ORM\ManyToOne(targetEntity="Salesperson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_salesperson", referencedColumnName="code")
     * })
     */
    private $salesperson;

    

    public function getSalesperson(): ? Salesperson
    {
        return $this->salesperson;
    }

    public function setSalesperson(Salesperson $salesperson): self
    {
        $this->salesperson = $salesperson;

        return $this;
    }

    public function getCode(): ? string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getGender(): ? string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getLastName(): ? string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ? string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getWorkName(): ? string
    {
        return $this->workName;
    }

    public function setWorkName(? string $workName): self
    {
        $this->workName = $workName;

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

    public function getArrivalDate(): ?\DateTime
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(?\Datetime $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

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

    public function getUpdatedAt(): ? \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getStatus(): ? bool
    {
        return $this->status;
    }

    public function setStatus(? bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    

    public function getBirthDate(): ? \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(? \DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getMobilePhone(): ? string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(? string $mobilePhone): self
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getStandardPhone(): ? string
    {
        return $this->standardPhone;
    }

    public function setStandardPhone(? string $standardPhone): self
    {
        $this->standardPhone = $standardPhone;

        return $this;
    }

    public function getPhone(): ? string
    {
        return $this->phone;
    }

    public function setPhone(? string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ? string
    {
        return $this->email;
    }

    public function setEmail(? string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailPrechecked(): ? bool
    {
        return $this->emailPrechecked;
    }

    public function setEmailPrechecked(? bool $emailPrechecked): self
    {
        $this->emailPrechecked = $emailPrechecked;

        return $this;
    }

    public function getEmailChecked(): ? bool
    {
        return $this->emailChecked;
    }

    public function setEmailChecked(? bool $emailChecked): self
    {
        $this->emailChecked = $emailChecked;

        return $this;
    }

    public function getLinkedin(): ? string
    {
        return $this->linkedin;
    }

    public function setLinkedin(? string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getFacebook(): ? string
    {
        return $this->facebook;
    }

    public function setFacebook(? string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ? string
    {
        return $this->twitter;
    }

    public function setTwitter(? string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getPicture(): ? string
    {
        return $this->picture;
    }

    public function setPicture(? string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getOperationSource(): ? string
    {
        return $this->operationSource;
    }

    public function setOperationSource(? string $operationSource): self
    {
        $this->operationSource = $operationSource;

        return $this;
    }

    public function getComment(): ? string
    {
        return $this->comment;
    }

    public function setComment(? string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getOptInNewsletter(): ? bool
    {
        return $this->optInNewsletter;
    }

    public function setOptInNewsletter(? bool $optInNewsletter): self
    {
        $this->optInNewsletter = $optInNewsletter;

        return $this;
    }

    public function getOptInOffresCommercial(): ? bool
    {
        return $this->optInOffresCommercial;
    }

    public function setOptInOffresCommercial(? bool $optInOffresCommercial): self
    {
        $this->optInOffresCommercial = $optInOffresCommercial;

        return $this;
    }

    public function getProfession(): ? Profession
    {
        return $this->profession;
    }

    public function setProfession(? Profession $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }


    public function __toString()
    {
        return $this->lastName . " " . $this->firstName;
    }

    public function getImageFile(): ? File
    {
        return $this->imageFile;
    }

    public function setImageFile(? File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getAge()
    {
        return $this->birthDate->diff(new \DateTime)->format("%Y");
    }

    public function getCivilite()
    {
        $civilite = "";
        switch($this->gender){
            case "Homme":
                $civilite = "M.";
            break;
            case "Femme":
                $civilite = "Madame";
            break;
        }
        return $civilite;
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

    /**
     * NOTE : Met le status du contact (à jour, à vérifier, obseléte) en fonction de la date d'update 
     * 
     * 
     * 
     */
    public function getStatutMaj(){
        $dateDiff = date_diff(new \DateTime(),  $this->updatedAt);
        $nbJour = $dateDiff->format("%R%a");
        

        // plus de 3 mois
        if($nbJour <= "-30" && $nbJour >= "-365")
        {
            $result = 'à vérifier';
        }
        // Moins de 3 mois
        if($nbJour > "-90")
        {
            $result = 'à jour';
        }
        // Plus de 12 mois
        if($nbJour <= "-365")
        {
            $result = 'obsolète';
        }
        return $result;
    }

    /**
     * Get the value of decision_making
     */ 
    public function getDecisionMaking()
    {
        return $this->decision_making;
    }

    /**
     * Set the value of decision_making
     *
     * @return  self
     */ 
    public function setDecisionMaking(DecisionMaking $decision_making)
    {
        $this->decision_making = $decision_making;

        return $this;
    }
}
