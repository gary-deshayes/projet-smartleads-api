<?php

namespace App\AdminBundle\Entity;

use App\AdminBundle\Entity\Country;
use App\AdminBundle\Entity\Turnovers;
use App\AdminBundle\Entity\Profession;
use App\AdminBundle\Entity\LegalStatus;
use App\AdminBundle\Entity\ActivityArea;
use App\AdminBundle\Entity\NumberEmployees;


use Symfony\Component\Validator\Constraints as Assert;

class ContactOperation
{
    
    /**
     * @var string
     * @Assert\NotBlank(
     *      message = "Cette valeur ne doit pas être vide."
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le nom doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le nom ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $name;

    /**
     * var CompanyStatus
     */
    private $companyStatus;

    /**
     * @var Country
     */
    private $country;

    /**
     * @var string|null
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'adresse ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $address;

    /**
     * @var string|null
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "Le code postal ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $postalCode;

    /**
     * @var string|null
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "La ville doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "La ville ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $town;

    /**
     * @var string|null
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
    private $phone_company;

    /**
     * @var string|null
     * @Assert\Regex(
     *      pattern="/^[0-9]*$/",
     *      message="Seulement les nombres sont autorisés")
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez saisir le fax en 0612345678",
     *      maxMessage = "Veuillez saisir le fax en 0612345678",
     *      exactMessage = "Le numéro de fax doit être à ce format 0XXXXXXXXX"
     * )
     */
    private $fax;

    /**
     * @var string|null
     * @Assert\Url
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le site web doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le site web ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $website;

    /**
     * @var string|null
     * @Assert\Length(
     *      min = 14,
     *      max = 14,
     *      minMessage = "Le numéro de SIRET doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le numéro de SIRET ne doit pas dépasser {{ limit }} caractères.",
     *      exactMessage = "Le numéro de SIRET doit contenir {{ limit }} caractères."
     * )
     */
    private $siret;

    /**
     * @var string|null
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'email ne doit pas dépasser {{ limit }} caractères."
     * )
     * @Assert\Email
     */
    private $email_company;

    /**
     * @var ActivityArea
     */
    private $activityArea;


    /**
     * @var LegalStatus
     */
    private $legalStatus;

    /**
     * @var NumberEmployees
     */
    private $numberEmployees;

    /**
     * @var Turnovers
     */
    private $turnovers;



    /**Partie contact */

    
    /**
     * @var string
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
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le prénom doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le prénom ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $firstName;


    /**
     * var DecisionMaking
     */
    private $decision_making;

    /**
     * @var \DateTime|null
     */
    private $birthDate;

    /**
     * @var string|null
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
    private $mobilePhone;

    /**
     * @var string|null
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
    private $phone_contact;

    /**
     * @var string|null
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
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le nom du poste ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $workName;

    /**
     * @var string|null
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'email ne doit pas dépasser {{ limit }} caractères."
     * )
     * @Assert\Email
     */
    private $email_contact;

    /**
     * @var string|null
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le lien LinkedIn ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $linkedin;

    /**
     * @var string|null
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le lien Facebook ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $facebook;

    
    /**
     * @var string|null
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le lien twitter ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $twitter;


    /**
     * @var Profession|null
     */
    private $profession;

    /**
     * Get the value of profession
     *
     * @return  \Profession
     */ 
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set the value of profession
     *
     * @param  \Profession  $profession
     *
     * @return  self
     */ 
    public function setProfession(? Profession $profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get max = 255,
     *
     * @return  string|null
     */ 
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set max = 255,
     *
     * @param  string|null  $twitter  max = 255,
     *
     * @return  self
     */ 
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get max = 255,
     *
     * @return  string|null
     */ 
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set max = 255,
     *
     * @param  string|null  $facebook  max = 255,
     *
     * @return  self
     */ 
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    } 
    
    /**
     * Get max = 255,
     *
     * @return  string|null
     */ 
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * Set max = 255,
     *
     * @param  string|null  $linkedin  max = 255,
     *
     * @return  self
     */ 
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get max = 255,
     *
     * @return  string|null
     */ 
    public function getWorkName()
    {
        return $this->workName;
    }

    /**
     * Set max = 255,
     *
     * @param  string|null  $workName  max = 255,
     *
     * @return  self
     */ 
    public function setWorkName($workName)
    {
        $this->workName = $workName;

        return $this;
    }

    /**
     * Get max = 255,
     *
     * @return  string|null
     */ 
    public function getEmailContact()
    {
        return $this->email_contact;
    }

    /**
     * Set max = 255,
     *
     * @param  string|null  $email_contact  max = 255,
     *
     * @return  self
     */ 
    public function setEmailContact($email_contact)
    {
        $this->email_contact = $email_contact;

        return $this;
    }

    /**
     * Get pattern="/^[0-9]*$/",
     *
     * @return  string|null
     */ 
    public function getStandardPhone()
    {
        return $this->standardPhone;
    }

    /**
     * Set pattern="/^[0-9]*$/",
     *
     * @param  string|null  $standardPhone  pattern="/^[0-9]*$/",
     *
     * @return  self
     */ 
    public function setStandardPhone($standardPhone)
    {
        $this->standardPhone = $standardPhone;

        return $this;
    }

    /**
     * Get pattern="/^[0-9]*$/",
     *
     * @return  string|null
     */ 
    public function getPhone()
    {
        return $this->phone_contact;
    }

    /**
     * Set pattern="/^[0-9]*$/",
     *
     * @param  string|null  $phone_contact  pattern="/^[0-9]*$/",
     *
     * @return  self
     */ 
    public function setPhone($phone_contact)
    {
        $this->phone_contact = $phone_contact;

        return $this;
    }

    /**
     * Get pattern="/^[0-9]*$/",
     *
     * @return  string|null
     */ 
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * Set pattern="/^[0-9]*$/",
     *
     * @param  string|null  $mobilePhone  pattern="/^[0-9]*$/",
     *
     * @return  self
     */ 
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * Get the value of birthDate
     *
     * @return  \DateTime|null
     */ 
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     *
     * @param  \DateTime|null  $birthDate
     *
     * @return  self
     */ 
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get var DecisionMaking
     */ 
    public function getDecision_making()
    {
        return $this->decision_making;
    }

    /**
     * Set var DecisionMaking
     *
     * @return  self
     */ 
    public function setDecision_making($decision_making)
    {
        $this->decision_making = $decision_making;

        return $this;
    }

    /**
     * Get message = "Cette valeur ne doit pas être vide."
     *
     * @return  string
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set message = "Cette valeur ne doit pas être vide."
     *
     * @param  string  $firstName  message = "Cette valeur ne doit pas être vide."
     *
     * @return  self
     */ 
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get message = "Cette valeur ne doit pas être vide."
     *
     * @return  string
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set message = "Cette valeur ne doit pas être vide."
     *
     * @param  string  $lastName  message = "Cette valeur ne doit pas être vide."
     *
     * @return  self
     */ 
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get message = "Cette valeur ne doit pas être vide."
     *
     * @return  string
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set message = "Cette valeur ne doit pas être vide."
     *
     * @param  string  $gender  message = "Cette valeur ne doit pas être vide."
     *
     * @return  self
     */ 
    public function setGender(? string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of turnovers
     *
     * @return  Turnovers
     */ 
    public function getTurnovers()
    {
        return $this->turnovers;
    }

    /**
     * Set the value of turnovers
     *
     * @param  Turnovers  $turnovers
     *
     * @return  self
     */ 
    public function setTurnovers(? Turnovers $turnovers)
    {
        $this->turnovers = $turnovers;

        return $this;
    }

    /**
     * Get the value of numberEmployees
     *
     * @return  \NumberEmployees
     */ 
    public function getNumberEmployees()
    {
        return $this->numberEmployees;
    }

    /**
     * Set the value of numberEmployees
     *
     * @param  NumberEmployees  $numberEmployees
     *
     * @return  self
     */ 
    public function setNumberEmployees(? NumberEmployees $numberEmployees)
    {
        $this->numberEmployees = $numberEmployees;

        return $this;
    }

    /**
     * Get the value of legalStatus
     *
     * @return  LegalStatus
     */ 
    public function getLegalStatus()
    {
        return $this->legalStatus;
    }

    /**
     * Set the value of legalStatus
     *
     * @param  LegalStatus  $legalStatus
     *
     * @return  self
     */ 
    public function setLegalStatus(LegalStatus $legalStatus)
    {
        $this->legalStatus = $legalStatus;

        return $this;
    }

    /**
     * Get the value of activityArea
     *
     * @return  \ActivityArea
     */ 
    public function getActivityArea()
    {
        return $this->activityArea;
    }

    /**
     * Set the value of activityArea
     *
     * @param  ActivityArea  $activityArea
     *
     * @return  self
     */ 
    public function setActivityArea(ActivityArea $activityArea)
    {
        $this->activityArea = $activityArea;

        return $this;
    }

    /**
     * Get max = 255,
     *
     * @return  string|null
     */ 
    public function getEmailCompany()
    {
        return $this->email_company;
    }

    /**
     * Set max = 255,
     *
     * @param  string|null  $email_company  max = 255,
     *
     * @return  self
     */ 
    public function setEmailCompany($email_company)
    {
        $this->email_company = $email_company;

        return $this;
    }

    /**
     * Get min = 14,
     *
     * @return  string|null
     */ 
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set min = 14,
     *
     * @param  string|null  $siret  min = 14,
     *
     * @return  self
     */ 
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get min = 1,
     *
     * @return  string|null
     */ 
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set min = 1,
     *
     * @param  string|null  $website  min = 1,
     *
     * @return  self
     */ 
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get pattern="/^[0-9]*$/",
     *
     * @return  string|null
     */ 
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set pattern="/^[0-9]*$/",
     *
     * @param  string|null  $fax  pattern="/^[0-9]*$/",
     *
     * @return  self
     */ 
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get pattern="/^[0-9]*$/",
     *
     * @return  string|null
     */ 
    public function getPhoneCompany()
    {
        return $this->phone_company;
    }

    /**
     * Set pattern="/^[0-9]*$/",
     *
     * @param  string|null  $phone_company  pattern="/^[0-9]*$/",
     *
     * @return  self
     */ 
    public function setPhoneCompany($phone_company)
    {
        $this->phone_company = $phone_company;

        return $this;
    }

    /**
     * Get min = 1,
     *
     * @return  string|null
     */ 
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set min = 1,
     *
     * @param  string|null  $town  min = 1,
     *
     * @return  self
     */ 
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get max = 100,
     *
     * @return  string|null
     */ 
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set max = 100,
     *
     * @param  string|null  $postalCode  max = 100,
     *
     * @return  self
     */ 
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get max = 255,
     *
     * @return  string|null
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set max = 255,
     *
     * @param  string|null  $address  max = 255,
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of country
     *
     * @return  Country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @param  Country  $country
     *
     * @return  self
     */ 
    public function setCountry(? Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get var CompanyStatus
     */ 
    public function getCompanyStatus()
    {
        return $this->companyStatus;
    }

    /**
     * Set var CompanyStatus
     *
     * @return  self
     */ 
    public function setCompanyStatus($companyStatus)
    {
        $this->companyStatus = $companyStatus;

        return $this;
    }

    /**
     * Get message = "Cette valeur ne doit pas être vide."
     *
     * @return  string
     */ 
    public function getNameCompany()
    {
        return $this->name;
    }

    /**
     * Set message = "Cette valeur ne doit pas être vide."
     *
     * @param  string  $name  message = "Cette valeur ne doit pas être vide."
     *
     * @return  self
     */ 
    public function setNameCompany(string $name)
    {
        $this->name = $name;

        return $this;
    }
}
