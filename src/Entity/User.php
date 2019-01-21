<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      maxMessage="Votre code est trop long!",
     * )
     */
    private $code;


    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      maxMessage="Votre prenom est trop long!"
     * )
     * @Groups({"Light"})
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      maxMessage="Votre nom est trop long!"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      maxMessage="Votre profil est trop long!"
     * )
     */
    private $profil;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     * @Assert\DateTime
     * )
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\NotBlank
     * @Assert\DateTime
     */
    private $update_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Length(max=20, maxMessage="Votre statut est trop long!")
     */
    private $statement;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $birth_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $job_name;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(max=20, maxMessage="Votre numéro est trop long!")
     */
    private $tel_mobile;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(max=20, maxMessage="Votre numéro est trop long!")
     */
    private $tel_fixe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(max=20, maxMessage="Votre email est trop long!")
     * 
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=20, maxMessage="Votre url est trop long!")
     */
    private $url_linkedin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=20, maxMessage="Votre url est trop long!")
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="user")
     * @Assert\NotBlank
     */
    private $contacts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Company", mappedBy="user")
     * @Assert\NotBlank
     */
    private $companies;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="subordinate")
     * @Assert\NotBlank
     */
    private $leader;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="leader")
     * @Assert\NotBlank
     */
    private $subordinate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Operation", mappedBy="user")
     * @Assert\NotBlank
     */
    private $operations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parameter", mappedBy="user")
     * @Assert\NotBlank
     */
    private $parameters;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gender", inversedBy="users")
     */
    private $gender;
    
  

   

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->companies = new ArrayCollection();
        $this->subordinate = new ArrayCollection();
        $this->operations = new ArrayCollection();
        $this->parameters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

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

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(string $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(?\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function getStatement(): ?bool
    {
        return $this->statement;
    }

    public function setStatement(?bool $statement): self
    {
        $this->statement = $statement;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(?\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getJobName(): ?string
    {
        return $this->job_name;
    }

    public function setJobName(?string $job_name): self
    {
        $this->job_name = $job_name;

        return $this;
    }

    public function getTelMobile(): ?string
    {
        return $this->tel_mobile;
    }

    public function setTelMobile(?string $tel_mobile): self
    {
        $this->tel_mobile = $tel_mobile;

        return $this;
    }

    public function getTelFixe(): ?string
    {
        return $this->tel_fixe;
    }

    public function setTelFixe(?string $tel_fixe): self
    {
        $this->tel_fixe = $tel_fixe;

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

    public function getUrlLinkedin(): ?string
    {
        return $this->url_linkedin;
    }

    public function setUrlLinkedin(?string $url_linkedin): self
    {
        $this->url_linkedin = $url_linkedin;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setUser($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getUser() === $this) {
                $contact->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Company[]
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->setUser($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            // set the owning side to null (unless already changed)
            if ($company->getUser() === $this) {
                $company->setUser(null);
            }
        }

        return $this;
    }

    public function getLeader(): ?self
    {
        return $this->leader;
    }

    public function setLeader(?self $leader): self
    {
        $this->leader = $leader;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSubordinate(): Collection
    {
        return $this->subordinate;
    }

    public function addSubordinate(self $subordinate): self
    {
        if (!$this->subordinate->contains($subordinate)) {
            $this->subordinate[] = $subordinate;
            $subordinate->setLeader($this);
        }

        return $this;
    }

    public function removeSubordinate(self $subordinate): self
    {
        if ($this->subordinate->contains($subordinate)) {
            $this->subordinate->removeElement($subordinate);
            // set the owning side to null (unless already changed)
            if ($subordinate->getLeader() === $this) {
                $subordinate->setLeader(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Operation[]
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations[] = $operation;
            $operation->setUser($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->contains($operation)) {
            $this->operations->removeElement($operation);
            // set the owning side to null (unless already changed)
            if ($operation->getUser() === $this) {
                $operation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Parameter[]
     */
    public function getParameters(): Collection
    {
        return $this->parameters;
    }

    public function addParameter(Parameter $parameter): self
    {
        if (!$this->parameters->contains($parameter)) {
            $this->parameters[] = $parameter;
            $parameter->setUser($this);
        }

        return $this;
    }

    public function removeParameter(Parameter $parameter): self
    {
        if ($this->parameters->contains($parameter)) {
            $this->parameters->removeElement($parameter);
            // set the owning side to null (unless already changed)
            if ($parameter->getUser() === $this) {
                $parameter->setUser(null);
            }
        }

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

   
}
