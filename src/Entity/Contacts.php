<?php

namespace App\Entity;

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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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

}
