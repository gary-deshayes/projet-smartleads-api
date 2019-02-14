<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company", indexes={@ORM\Index(name="company_company_category0_FK", columns={"id_company_category"}), @ORM\Index(name="company_legal_status2_FK", columns={"id_legal_status"}), @ORM\Index(name="company_activity_area_FK", columns={"id_activity_area"}), @ORM\Index(name="company_number_employees1_FK", columns={"id_number_employees"}), @ORM\Index(name="id_salesperson", columns={"id_salesperson"})})
 * @ORM\Entity
 */
class Company
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

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
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var string|null
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=0, nullable=true)
     */
    private $comment;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="additional_address", type="string", length=255, nullable=true)
     */
    private $additionalAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postal_code", type="string", length=5, nullable=true)
     */
    private $postalCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="town", type="string", length=255, nullable=true)
     */
    private $town;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=10, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fax", type="string", length=10, nullable=true)
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at_company", type="datetime", nullable=true)
     */
    private $createdAtCompany;

    /**
     * @var string|null
     *
     * @ORM\Column(name="siret", type="string", length=14, nullable=true)
     */
    private $siret;

    /**
     * @var string|null
     *
     * @ORM\Column(name="naf_code", type="string", length=5, nullable=true)
     */
    private $nafCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="source", type="string", length=5, nullable=true)
     */
    private $source;

    /**
     * @var \ActivityArea
     *
     * @ORM\ManyToOne(targetEntity="ActivityArea")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_activity_area", referencedColumnName="id")
     * })
     */
    private $idActivityArea;

    /**
     * @var \CompanyCategory
     *
     * @ORM\ManyToOne(targetEntity="CompanyCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_company_category", referencedColumnName="id")
     * })
     */
    private $idCompanyCategory;

    /**
     * @var \Salesperson
     *
     * @ORM\ManyToOne(targetEntity="Salesperson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_salesperson", referencedColumnName="code")
     * })
     */
    private $idSalesperson;

    /**
     * @var \LegalStatus
     *
     * @ORM\ManyToOne(targetEntity="LegalStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_legal_status", referencedColumnName="id")
     * })
     */
    private $idLegalStatus;

    /**
     * @var \NumberEmployees
     *
     * @ORM\ManyToOne(targetEntity="NumberEmployees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_number_employees", referencedColumnName="id")
     * })
     */
    private $idNumberEmployees;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Turnovers", inversedBy="idCompany")
     * @ORM\JoinTable(name="last_turnovers",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_company", referencedColumnName="code")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_turnovers", referencedColumnName="id")
     *   }
     * )
     */
    private $idTurnovers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Contacts", mappedBy="idCompany")
     */
    private $idContact;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idTurnovers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idContact = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
