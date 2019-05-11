<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\FormulaireOperationRepository")
 */
class FormulaireOperation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @OneToOne(targetEntity="Operations", mappedBy="formulaire_operation")
     * * @JoinColumn(name="operation", referencedColumnName="code")
     */
    protected $operation;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_gender;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_firstname;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_lastname;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_birthdate;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_mail_pro;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_phone;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_mobile_phone;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_linkedin;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_twitter;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_facebook;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_profession;

    /**
     * @ORM\Column(type="integer")
     */
    private $contacts_workname;


    /**
     * @ORM\Column(type="integer")
     */
    private $company_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_naf;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_legal_status;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_siret;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_number_employees;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_turnovers;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_address;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_postal_code;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_country;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_standard_phone;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_fax;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_website;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_mail;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of company_mail
     */ 
    public function getCompanyMail()
    {
        return $this->company_mail;
    }

    /**
     * Set the value of company_mail
     *
     * @return  self
     */ 
    public function setCompanyMail($company_mail)
    {
        $this->company_mail = $company_mail;

        return $this;
    }

    /**
     * Get the value of company_website
     */ 
    public function getCompanyWebsite()
    {
        return $this->company_website;
    }

    /**
     * Set the value of company_website
     *
     * @return  self
     */ 
    public function setCompanyWebsite($company_website)
    {
        $this->company_website = $company_website;

        return $this;
    }

    /**
     * Get the value of company_fax
     */ 
    public function getCompanyFax()
    {
        return $this->company_fax;
    }

    /**
     * Set the value of company_fax
     *
     * @return  self
     */ 
    public function setCompanyFax($company_fax)
    {
        $this->company_fax = $company_fax;

        return $this;
    }

    /**
     * Get the value of company_standard_phone
     */ 
    public function getCompanyStandardPhone()
    {
        return $this->company_standard_phone;
    }

    /**
     * Set the value of company_standard_phone
     *
     * @return  self
     */ 
    public function setCompanyStandardPhone($company_standard_phone)
    {
        $this->company_standard_phone = $company_standard_phone;

        return $this;
    }

    /**
     * Get the value of company_country
     */ 
    public function getCompanyCountry()
    {
        return $this->company_country;
    }

    /**
     * Set the value of company_country
     *
     * @return  self
     */ 
    public function setCompanyCountry($company_country)
    {
        $this->company_country = $company_country;

        return $this;
    }

    /**
     * Get the value of company_postal_code
     */ 
    public function getCompanyPostalCode()
    {
        return $this->company_postal_code;
    }

    /**
     * Set the value of company_postal_code
     *
     * @return  self
     */ 
    public function setCompanyPostalCode($company_postal_code)
    {
        $this->company_postal_code = $company_postal_code;

        return $this;
    }

    /**
     * Get the value of company_address
     */ 
    public function getCompanyAddress()
    {
        return $this->company_address;
    }

    /**
     * Set the value of company_address
     *
     * @return  self
     */ 
    public function setCompanyAddress($company_address)
    {
        $this->company_address = $company_address;

        return $this;
    }

    /**
     * Get the value of company_turnovers
     */ 
    public function getCompanyTurnovers()
    {
        return $this->company_turnovers;
    }

    /**
     * Set the value of company_turnovers
     *
     * @return  self
     */ 
    public function setCompanyTurnovers($company_turnovers)
    {
        $this->company_turnovers = $company_turnovers;

        return $this;
    }

    /**
     * Get the value of company_number_employees
     */ 
    public function getCompanyNumberEmployees()
    {
        return $this->company_number_employees;
    }

    /**
     * Set the value of company_number_employees
     *
     * @return  self
     */ 
    public function setCompanyNumberEmployees($company_number_employees)
    {
        $this->company_number_employees = $company_number_employees;

        return $this;
    }

    /**
     * Get the value of company_siret
     */ 
    public function getCompanySiret()
    {
        return $this->company_siret;
    }

    /**
     * Set the value of company_siret
     *
     * @return  self
     */ 
    public function setCompanySiret($company_siret)
    {
        $this->company_siret = $company_siret;

        return $this;
    }

    /**
     * Get the value of company_legal_status
     */ 
    public function getCompanyLegalStatus()
    {
        return $this->company_legal_status;
    }

    /**
     * Set the value of company_legal_status
     *
     * @return  self
     */ 
    public function setCompanyLegalStatus($company_legal_status)
    {
        $this->company_legal_status = $company_legal_status;

        return $this;
    }

    /**
     * Get the value of company_naf
     */ 
    public function getCompanyNaf()
    {
        return $this->company_naf;
    }

    /**
     * Set the value of company_naf
     *
     * @return  self
     */ 
    public function setCompanyNaf($company_naf)
    {
        $this->company_naf = $company_naf;

        return $this;
    }

    /**
     * Get the value of company_name
     */ 
    public function getCompanyName()
    {
        return $this->company_name;
    }

    /**
     * Set the value of company_name
     *
     * @return  self
     */ 
    public function setCompanyName($company_name)
    {
        $this->company_name = $company_name;

        return $this;
    }

    /**
     * Get the value of contacts_workname
     */ 
    public function getContactsWorkname()
    {
        return $this->contacts_workname;
    }

    /**
     * Set the value of contacts_workname
     *
     * @return  self
     */ 
    public function setContactsWorkname($contacts_workname)
    {
        $this->contacts_workname = $contacts_workname;

        return $this;
    }

    /**
     * Get the value of contacts_profession
     */ 
    public function getContactsProfession()
    {
        return $this->contacts_profession;
    }

    /**
     * Set the value of contacts_profession
     *
     * @return  self
     */ 
    public function setContactsProfession($contacts_profession)
    {
        $this->contacts_profession = $contacts_profession;

        return $this;
    }

    /**
     * Get the value of contacts_facebook
     */ 
    public function getContactsFacebook()
    {
        return $this->contacts_facebook;
    }

    /**
     * Set the value of contacts_facebook
     *
     * @return  self
     */ 
    public function setContactsFacebook($contacts_facebook)
    {
        $this->contacts_facebook = $contacts_facebook;

        return $this;
    }

    /**
     * Get the value of contacts_twitter
     */ 
    public function getContactsTwitter()
    {
        return $this->contacts_twitter;
    }

    /**
     * Set the value of contacts_twitter
     *
     * @return  self
     */ 
    public function setContactsTwitter($contacts_twitter)
    {
        $this->contacts_twitter = $contacts_twitter;

        return $this;
    }

    /**
     * Get the value of contacts_linkedin
     */ 
    public function getContactsLinkedin()
    {
        return $this->contacts_linkedin;
    }

    /**
     * Set the value of contacts_linkedin
     *
     * @return  self
     */ 
    public function setContactsLinkedin($contacts_linkedin)
    {
        $this->contacts_linkedin = $contacts_linkedin;

        return $this;
    }

    /**
     * Get the value of contacts_mobile_phone
     */ 
    public function getContactsMobilePhone()
    {
        return $this->contacts_mobile_phone;
    }

    /**
     * Set the value of contacts_mobile_phone
     *
     * @return  self
     */ 
    public function setContactsMobilePhone($contacts_mobile_phone)
    {
        $this->contacts_mobile_phone = $contacts_mobile_phone;

        return $this;
    }

    /**
     * Get the value of contacts_phone
     */ 
    public function getContactsPhone()
    {
        return $this->contacts_phone;
    }

    /**
     * Set the value of contacts_phone
     *
     * @return  self
     */ 
    public function setContactsPhone($contacts_phone)
    {
        $this->contacts_phone = $contacts_phone;

        return $this;
    }

    /**
     * Get the value of contacts_mail_pro
     */ 
    public function getContactsMailPro()
    {
        return $this->contacts_mail_pro;
    }

    /**
     * Set the value of contacts_mail_pro
     *
     * @return  self
     */ 
    public function setContactsMailPro($contacts_mail_pro)
    {
        $this->contacts_mail_pro = $contacts_mail_pro;

        return $this;
    }

    /**
     * Get the value of contacts_birthdate
     */ 
    public function getContactsBirthdate()
    {
        return $this->contacts_birthdate;
    }

    public function getcontacts_birthdate()
    {
        return $this->contacts_birthdate;
    }

    /**
     * Set the value of contacts_birthdate
     *
     * @return  self
     */ 
    public function setContactsBirthdate($contacts_birthdate)
    {
        $this->contacts_birthdate = $contacts_birthdate;

        return $this;
    }

    /**
     * Get the value of contacts_lastname
     */ 
    public function getContactsLastname()
    {
        return $this->contacts_lastname;
    }

    public function getcontacts_lastname()
    {
        return $this->contacts_lastname;
    }

    /**
     * Set the value of contacts_lastname
     *
     * @return  self
     */ 
    public function setContactsLastname($contacts_lastname)
    {
        $this->contacts_lastname = $contacts_lastname;

        return $this;
    }

    /**
     * Get the value of contacts_firstname
     */ 
    public function getContactsFirstname()
    {
        return $this->contacts_firstname;
    }

    public function getcontacts_firstname()
    {
        return $this->contacts_firstname;
    }

    /**
     * Set the value of contacts_firstname
     *
     * @return  self
     */ 
    public function setContactsFirstname($contacts_firstname)
    {
        $this->contacts_firstname = $contacts_firstname;

        return $this;
    }

    /**
     * Get the value of contacts_gender
     */ 
    public function getContactsGender()
    {
        return $this->contacts_gender;
    }

    //Doctrine generait une classe Proxy identique a cette classe qui demandait cette méthode, je n'ai pas compris pourquoi
    public function getcontacts_gender()
    {
        return $this->contacts_gender;
    }

    

    /**
     * Set the value of contacts_gender
     *
     * @return  self
     */ 
    public function setContactsGender($contacts_gender)
    {
        $this->contacts_gender = $contacts_gender;

        return $this;
    }

    /**
     * Get the value of operation
     */ 
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Set the value of operation
     *
     * @return  self
     */ 
    public function setOperation(Operations $operation)
    {
        $this->operation = $operation;

        return $this;
    }
}
