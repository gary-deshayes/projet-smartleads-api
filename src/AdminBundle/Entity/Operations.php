<?php

namespace App\AdminBundle\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use App\AdminBundle\Entity\Salesperson;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Operations
 *
 * @ORM\Table(name="operations")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\OperationsRepository")
 * @Vich\Uploadable
 */
class Operations
{

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     * @Assert\NotBlank(
     * message = "Cette valeur ne doit pas être vide")
     * @ORM\Id
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    

    /**
     * @var int
     *
     * @ORM\Column(name="revival", type="integer", nullable=false)
     */
    private $revival;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=0, nullable=true)
     */
    private $comment;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="operation_logo", fileNameProperty="logo")
     * @Assert\Image(
     *     mimeTypes = {"image/png", "image/jpeg", "image/gif"}
     * )
     * @var File
     */
    private $imageFile;

    /**
     * @var string|null
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     
     */
    private $logo;

    /**
     * @var \DateTime|null
     * @Assert\DateTime
     * @ORM\Column(name="sending_date", type="datetime", nullable=true)
     */
    private $sending_date;

    /**
     * @var \DateTime|null
     * @Assert\DateTime
     * @ORM\Column(name="closing_date", type="datetime", nullable=true)
     */
    private $closing_date;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $created_at;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updated_at;

    /**
     * @var \Salesperson
     *
     * @ORM\ManyToOne(targetEntity="Salesperson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_author", referencedColumnName="code")
     * })
     */
    private $author;

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
     * @OneToOne(targetEntity="FormulaireOperation")
     * @JoinColumn(name="form_data", referencedColumnName="id")
     */
    protected $formulaire_operation;

    /**
     * @var notification
     * @ORM\Column(name="opt_information", type="boolean", nullable=false, options={"default": false})
     */
    protected $opt_information;

    /**
     * @var notification
     * @ORM\Column(name="opt_sales_offer", type="boolean", nullable=false, options={"default": false})
     */
    protected $opt_sales_offer;

    /**
     * @OneToOne(targetEntity="SettingsOperation")
     * @JoinColumn(name="settings", referencedColumnName="operation_code")
     */
    private $settings;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): ?self
    {
         $this->name = $name;

         return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode($code): ?self
    {
         $this->code = $code;

         return $this;
    }
    
    public function getRevival(): ?int
    {
        return $this->revival;
    }

    public function setRevival($revival): ?self
    {
         $this->revival = $revival;

         return $this;
    }

    public function getCreated_At(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreated_At(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getSendingDate(): ?\DateTimeInterface
    {
        return $this->sending_date;
    }

    public function setSendingDate(? \DateTimeInterface $sending_date): self
    {
        $this->sending_date = $sending_date;

        return $this;
    }

    public function getClosingDate(): ?\DateTimeInterface
    {
        return $this->closing_date;
    }

    public function setClosingDate(? \DateTimeInterface $closing_date): self
    {
        $this->closing_date = $closing_date;

        return $this;
    }

    public function getAuthor(): ?Salesperson
    {
        return $this->author;
    }

    public function setAuthor(?Salesperson $author): self
    {
        $this->author = $author;

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

    public function getLogo(): ? string
    {
        return $this->logo;
    }

    public function setLogo(? string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function __toString(){
        return $this->name;
    }

    /**
     * @Assert\Callback
     * Si la date de début est plus grande que la date de fin 
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if ($this->getSendingDate() > $this->getClosingDate()) {
            $context->buildViolation('La date de début doit être inférieur à la date de fin')
                ->atPath('sending_date')
                ->addViolation();
        }
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
     * Get the value of formulaire_operation
     */ 
    public function getFormulaire_operation()
    {
        return $this->formulaire_operation;
    }

    /**
     * Set the value of formulaire_operation
     *
     * @return  self
     */ 
    public function setFormulaire_operation(FormulaireOperation $formulaire_operation)
    {
        $this->formulaire_operation = $formulaire_operation;

        return $this;
    }

    /**
     * Get the value of opt_information
     *
     * @return  notification
     */ 
    public function getOptInformation()
    {
        return $this->opt_information;
    }

    /**
     * Set the value of opt_information
     *
     * @param  notification  $opt_information
     *
     * @return  self
     */ 
    public function setOptInformation(notification $opt_information)
    {
        $this->opt_information = $opt_information;

        return $this;
    }

    /**
     * Get the value of opt_sales_offer
     *
     * @return  notification
     */ 
    public function getOptSalesOffer()
    {
        return $this->opt_sales_offer;
    }

    /**
     * Set the value of opt_sales_offer
     *
     * @param  notification  $opt_sales_offer
     *
     * @return  self
     */ 
    public function setOptSalesOffer(notification $opt_sales_offer)
    {
        $this->opt_sales_offer = $opt_sales_offer;

        return $this;
    }

    /**
     * Get the value of settings
     */ 
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set the value of settings
     *
     * @return  self
     */ 
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }
}
