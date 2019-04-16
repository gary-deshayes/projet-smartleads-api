<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    public function getCompany_mail()
    {
        return $this->company_mail;
    }

    /**
     * Set the value of company_mail
     *
     * @return  self
     */ 
    public function setCompany_mail($company_mail)
    {
        $this->company_mail = $company_mail;

        return $this;
    }

    /**
     * Get the value of company_website
     */ 
    public function getCompany_website()
    {
        return $this->company_website;
    }

    /**
     * Set the value of company_website
     *
     * @return  self
     */ 
    public function setCompany_website($company_website)
    {
        $this->company_website = $company_website;

        return $this;
    }

    /**
     * Get the value of company_fax
     */ 
    public function getCompany_fax()
    {
        return $this->company_fax;
    }

    /**
     * Set the value of company_fax
     *
     * @return  self
     */ 
    public function setCompany_fax($company_fax)
    {
        $this->company_fax = $company_fax;

        return $this;
    }

    /**
     * Get the value of company_standard_phone
     */ 
    public function getCompany_standard_phone()
    {
        return $this->company_standard_phone;
    }

    /**
     * Set the value of company_standard_phone
     *
     * @return  self
     */ 
    public function setCompany_standard_phone($company_standard_phone)
    {
        $this->company_standard_phone = $company_standard_phone;

        return $this;
    }

    /**
     * Get the value of company_country
     */ 
    public function getCompany_country()
    {
        return $this->company_country;
    }

    /**
     * Set the value of company_country
     *
     * @return  self
     */ 
    public function setCompany_country($company_country)
    {
        $this->company_country = $company_country;

        return $this;
    }

    /**
     * Get the value of company_postal_code
     */ 
    public function getCompany_postal_code()
    {
        return $this->company_postal_code;
    }

    /**
     * Set the value of company_postal_code
     *
     * @return  self
     */ 
    public function setCompany_postal_code($company_postal_code)
    {
        $this->company_postal_code = $company_postal_code;

        return $this;
    }

    /**
     * Get the value of company_address
     */ 
    public function getCompany_address()
    {
        return $this->company_address;
    }

    /**
     * Set the value of company_address
     *
     * @return  self
     */ 
    public function setCompany_address($company_address)
    {
        $this->company_address = $company_address;

        return $this;
    }

    /**
     * Get the value of company_turnovers
     */ 
    public function getCompany_turnovers()
    {
        return $this->company_turnovers;
    }

    /**
     * Set the value of company_turnovers
     *
     * @return  self
     */ 
    public function setCompany_turnovers($company_turnovers)
    {
        $this->company_turnovers = $company_turnovers;

        return $this;
    }

    /**
     * Get the value of company_number_employees
     */ 
    public function getCompany_number_employees()
    {
        return $this->company_number_employees;
    }

    /**
     * Set the value of company_number_employees
     *
     * @return  self
     */ 
    public function setCompany_number_employees($company_number_employees)
    {
        $this->company_number_employees = $company_number_employees;

        return $this;
    }

    /**
     * Get the value of company_siret
     */ 
    public function getCompany_siret()
    {
        return $this->company_siret;
    }

    /**
     * Set the value of company_siret
     *
     * @return  self
     */ 
    public function setCompany_siret($company_siret)
    {
        $this->company_siret = $company_siret;

        return $this;
    }

    /**
     * Get the value of company_legal_status
     */ 
    public function getCompany_legal_status()
    {
        return $this->company_legal_status;
    }

    /**
     * Set the value of company_legal_status
     *
     * @return  self
     */ 
    public function setCompany_legal_status($company_legal_status)
    {
        $this->company_legal_status = $company_legal_status;

        return $this;
    }

    /**
     * Get the value of company_naf
     */ 
    public function getCompany_naf()
    {
        return $this->company_naf;
    }

    /**
     * Set the value of company_naf
     *
     * @return  self
     */ 
    public function setCompany_naf($company_naf)
    {
        $this->company_naf = $company_naf;

        return $this;
    }

    /**
     * Get the value of company_name
     */ 
    public function getCompany_name()
    {
        return $this->company_name;
    }

    /**
     * Set the value of company_name
     *
     * @return  self
     */ 
    public function setCompany_name($company_name)
    {
        $this->company_name = $company_name;

        return $this;
    }

    /**
     * Get the value of contacts_workname
     */ 
    public function getContacts_workname()
    {
        return $this->contacts_workname;
    }

    /**
     * Set the value of contacts_workname
     *
     * @return  self
     */ 
    public function setContacts_workname($contacts_workname)
    {
        $this->contacts_workname = $contacts_workname;

        return $this;
    }

    /**
     * Get the value of contacts_profession
     */ 
    public function getContacts_profession()
    {
        return $this->contacts_profession;
    }

    /**
     * Set the value of contacts_profession
     *
     * @return  self
     */ 
    public function setContacts_profession($contacts_profession)
    {
        $this->contacts_profession = $contacts_profession;

        return $this;
    }

    /**
     * Get the value of contacts_facebook
     */ 
    public function getContacts_facebook()
    {
        return $this->contacts_facebook;
    }

    /**
     * Set the value of contacts_facebook
     *
     * @return  self
     */ 
    public function setContacts_facebook($contacts_facebook)
    {
        $this->contacts_facebook = $contacts_facebook;

        return $this;
    }

    /**
     * Get the value of contacts_twitter
     */ 
    public function getContacts_twitter()
    {
        return $this->contacts_twitter;
    }

    /**
     * Set the value of contacts_twitter
     *
     * @return  self
     */ 
    public function setContacts_twitter($contacts_twitter)
    {
        $this->contacts_twitter = $contacts_twitter;

        return $this;
    }

    /**
     * Get the value of contacts_linkedin
     */ 
    public function getContacts_linkedin()
    {
        return $this->contacts_linkedin;
    }

    /**
     * Set the value of contacts_linkedin
     *
     * @return  self
     */ 
    public function setContacts_linkedin($contacts_linkedin)
    {
        $this->contacts_linkedin = $contacts_linkedin;

        return $this;
    }

    /**
     * Get the value of contacts_mobile_phone
     */ 
    public function getContacts_mobile_phone()
    {
        return $this->contacts_mobile_phone;
    }

    /**
     * Set the value of contacts_mobile_phone
     *
     * @return  self
     */ 
    public function setContacts_mobile_phone($contacts_mobile_phone)
    {
        $this->contacts_mobile_phone = $contacts_mobile_phone;

        return $this;
    }

    /**
     * Get the value of contacts_phone
     */ 
    public function getContacts_phone()
    {
        return $this->contacts_phone;
    }

    /**
     * Set the value of contacts_phone
     *
     * @return  self
     */ 
    public function setContacts_phone($contacts_phone)
    {
        $this->contacts_phone = $contacts_phone;

        return $this;
    }

    /**
     * Get the value of contacts_mail_pro
     */ 
    public function getContacts_mail_pro()
    {
        return $this->contacts_mail_pro;
    }

    /**
     * Set the value of contacts_mail_pro
     *
     * @return  self
     */ 
    public function setContacts_mail_pro($contacts_mail_pro)
    {
        $this->contacts_mail_pro = $contacts_mail_pro;

        return $this;
    }

    /**
     * Get the value of contacts_birthdate
     */ 
    public function getContacts_birthdate()
    {
        return $this->contacts_birthdate;
    }

    /**
     * Set the value of contacts_birthdate
     *
     * @return  self
     */ 
    public function setContacts_birthdate($contacts_birthdate)
    {
        $this->contacts_birthdate = $contacts_birthdate;

        return $this;
    }

    /**
     * Get the value of contacts_lastname
     */ 
    public function getContacts_lastname()
    {
        return $this->contacts_lastname;
    }

    /**
     * Set the value of contacts_lastname
     *
     * @return  self
     */ 
    public function setContacts_lastname($contacts_lastname)
    {
        $this->contacts_lastname = $contacts_lastname;

        return $this;
    }

    /**
     * Get the value of contacts_firstname
     */ 
    public function getContacts_firstname()
    {
        return $this->contacts_firstname;
    }

    /**
     * Set the value of contacts_firstname
     *
     * @return  self
     */ 
    public function setContacts_firstname($contacts_firstname)
    {
        $this->contacts_firstname = $contacts_firstname;

        return $this;
    }

    /**
     * Get the value of contacts_gender
     */ 
    public function getContacts_gender()
    {
        return $this->contacts_gender;
    }

    /**
     * Set the value of contacts_gender
     *
     * @return  self
     */ 
    public function setContacts_gender($contacts_gender)
    {
        $this->contacts_gender = $contacts_gender;

        return $this;
    }
}
