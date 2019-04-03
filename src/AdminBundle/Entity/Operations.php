<?php

namespace App\AdminBundle\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=255, nullable=false)
     */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_object", type="string", length=255, nullable=false)
     */
    private $mail_object;

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
     * @ORM\Column(name="state", type="text", length=255, nullable=false)
     */
    private $state;

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
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="sending_date", type="datetime", nullable=false)
     */
    private $sending_date;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="closing_date", type="datetime", nullable=false)
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

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState($state): ?self
    {
         $this->state = $state;

         return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate($template): ?self
    {
         $this->template = $template;

         return $this;
    }

    public function getMailObject(): ?string
    {
        return $this->mail_object;
    }

    public function setMailObject(string $mail_object): ?self
    {
         $this->mail_object = $mail_object;

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

    public function setSendingDate(\DateTimeInterface $sending_date): self
    {
        $this->sending_date = $sending_date;

        return $this;
    }

    public function getClosingDate(): ?\DateTimeInterface
    {
        return $this->closing_date;
    }

    public function setClosingDate(\DateTimeInterface $closing_date): self
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


}
