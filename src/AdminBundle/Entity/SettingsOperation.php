<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\SettingsOperationRepository")
 * @Vich\Uploadable
 */
class SettingsOperation
{
    /**
     * @ORM\Id()
     * @OneToOne(targetEntity="Operations")
     * @JoinColumn(name="operation_code", referencedColumnName="code")
     */
    private $operation;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_object", type="string", length=255, nullable=false)
     */
    private $mail_object;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="operation_img", fileNameProperty="mail_visual")
     * @Assert\Image(
     *     mimeTypes = {"image/png", "image/jpeg", "image/gif"}
     * )
     * @var File
     */
    private $mail_image;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_visual", type="string", length=255, nullable=true)
     */
    private $mail_visual;

    /**
     * @var string
     *
     * @ORM\Column(name="text_mail", type="text", nullable=false)
     */
    private $text_mail;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_button_mail", type="string", length=255, nullable=true)
     */
    private $libelle_button_mail;

    /**
     * @var string
     *
     * @ORM\Column(name="title_page", type="string", length=255, nullable=false)
     */
    private $title_page;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="operation_img", fileNameProperty="page_visual")
     * @Assert\Image(
     *     mimeTypes = {"image/png", "image/jpeg", "image/gif"}
     * )
     * @var File
     */
    private $page_image;

    /**
     * @var string
     *
     * @ORM\Column(name="page_visual", type="string", length=255, nullable=true)
     */
    private $page_visual;

    /**
     * @var string
     *
     * @ORM\Column(name="introduction_title", type="string", length=255, nullable=false)
     */
    private $introduction_title;

    /**
     * @var string
     *
     * @ORM\Column(name="introduction_text", type="text", nullable=false)
     */
    private $introduction_text;

    
    /**
     * @var string
     *
     * @ORM\Column(name="libelle_button_page", type="string", length=255, nullable=true)
     */
    private $libelle_button_page;

    /**
     * @var string
     *
     * @ORM\Column(name="button_reject", type="boolean", nullable=true, options={"default": false})
     */
    private $button_reject;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

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
    public function setOperation($operation)
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Get the value of mail_object
     *
     * @return  string
     */ 
    public function getMailObject()
    {
        return $this->mail_object;
    }

    /**
     * Set the value of mail_object
     *
     * @param  string  $mail_object
     *
     * @return  self
     */ 
    public function setMailObject(string $mail_object)
    {
        $this->mail_object = $mail_object;

        return $this;
    }

    /**
     * Get the value of mail_visual
     *
     * @return  string
     */ 
    public function getMailVisual()
    {
        return $this->mail_visual;
    }

    /**
     * Set the value of mail_visual
     *
     * @param  string  $mail_visual
     *
     * @return  self
     */ 
    public function setMailVisual(?string $mail_visual)
    {
        $this->mail_visual = $mail_visual;

        return $this;
    }

    /**
     * Get the value of text_mail
     *
     * @return  string
     */ 
    public function getTextMail()
    {
        return $this->text_mail;
    }

    /**
     * Set the value of text_mail
     *
     * @param  string  $text_mail
     *
     * @return  self
     */ 
    public function setTextMail(string $text_mail)
    {
        $this->text_mail = $text_mail;

        return $this;
    }

    /**
     * Get the value of libelle_button_mail
     *
     * @return  string
     */ 
    public function getLibelleButtonMail()
    {
        return $this->libelle_button_mail;
    }

    /**
     * Set the value of libelle_button_mail
     *
     * @param  string  $libelle_button_mail
     *
     * @return  self
     */ 
    public function setLibelleButtonMail(string $libelle_button_mail)
    {
        $this->libelle_button_mail = $libelle_button_mail;

        return $this;
    }

    /**
     * Get the value of title_page
     *
     * @return  string
     */ 
    public function gettitle_page()
    {
        return $this->title_page;
    }

    public function getTitlePage()
    {
        return $this->title_page;
    }

    /**
     * Set the value of title_page
     *
     * @param  string  $title_page
     *
     * @return  self
     */ 
    public function setTitlePage(string $title_page)
    {
        $this->title_page = $title_page;

        return $this;
    }

    /**
     * Get the value of page_visual
     *
     * @return  string
     */ 
    public function getPageVisual()
    {
        return $this->page_visual;
    }

    /**
     * Set the value of page_visual
     *
     * @param  string  $page_visual
     *
     * @return  self
     */ 
    public function setPageVisual(?string $page_visual)
    {
        $this->page_visual = $page_visual;

        return $this;
    }

    /**
     * Get the value of introduction_title
     *
     * @return  string
     */ 
    public function getintroduction_title()
    {
        return $this->introduction_title;
    }

    public function getIntroductionTitle()
    {
        return $this->introduction_title;
    }

    /**
     * Set the value of introduction_title
     *
     * @param  string  $introduction_title
     *
     * @return  self
     */ 
    public function setIntroductionTitle(string $introduction_title)
    {
        $this->introduction_title = $introduction_title;

        return $this;
    }

    /**
     * Get the value of introduction_text
     *
     * @return  string
     */ 
    public function getintroduction_text()
    {
        return $this->introduction_text;
    }

    public function getIntroductionText()
    {
        return $this->introduction_text;
    }

    /**
     * Set the value of introduction_text
     *
     * @param  string  $introduction_text
     *
     * @return  self
     */ 
    public function setIntroductionText(string $introduction_text)
    {
        $this->introduction_text = $introduction_text;

        return $this;
    }

    /**
     * Get the value of libelle_button_page
     *
     * @return  string
     */ 
    public function getLibelleButtonPage()
    {
        return $this->libelle_button_page;
    }

    /**
     * Set the value of libelle_button_page
     *
     * @param  string  $libelle_button_page
     *
     * @return  self
     */ 
    public function setLibelleButtonPage(string $libelle_button_page)
    {
        $this->libelle_button_page = $libelle_button_page;

        return $this;
    }

    /**
     * Get the value of button_reject
     *
     * @return  string
     */ 
    public function getButtonReject()
    {
        return $this->button_reject;
    }

    /**
     * Set the value of button_reject
     *
     * @param  string  $button_reject
     *
     * @return  self
     */ 
    public function setButtonReject(string $button_reject)
    {
        $this->button_reject = $button_reject;

        return $this;
    }

    public function getMailImage(): ? File
    {
        return $this->mail_image;
    }

    public function setMailImage(? File $mail_image = null): void
    {
        $this->mail_image = $mail_image;

        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->mail_image instanceof UploadedFile) {
            dump($mail_image);
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getPageImage(): ? File
    {
        return $this->page_image;
    }

    public function setPageImage(? File $page_image = null): void
    {
        
        $this->page_image = $page_image;

        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->page_image instanceof UploadedFile) {
            dump($page_image);
            $this->updatedAt = new \DateTime('now');
        }
    }
}
