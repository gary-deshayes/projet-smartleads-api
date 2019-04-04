<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperationSent
 *
 * @ORM\Table(name="operation_sent", indexes={@ORM\Index(name="id_contacts", columns={"id_contacts"}), @ORM\Index(name="id_operation", columns={"id_operation"}), @ORM\Index(name="IDX_95B4773850B241AB", columns={"id_salesperson"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\OperationSentRepository")
 */
class OperationSent
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent_at", type="datetime", nullable=false)
     */
    private $sentAt;

    /**
     * @var \Salesperson
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Salesperson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_salesperson", referencedColumnName="code")
     * })
     */
    private $salesperson;

    /**
     * @var \Operations
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Operations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_operation", referencedColumnName="code")
     * })
     */
    private $operation;

    /**
     * @var \Contacts
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Contacts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_contacts", referencedColumnName="code")
     * })
     */
    private $contacts;

    /**
     * @var int
     * 1 = envoyé
     * 2 = ouvert
     * 3 = mis à jour
     * 
     * @ORM\Column(name="state", type="integer", length=11, nullable=false)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="uniqIdContact", type="string", length=255, nullable=false)
     */
    private $uniqIdContact;

    public function getUniqIdContact(): ?string
    {
        return $this->uniqIdContact;
    }

    public function setUniqIdContact(string $uniqIdContact): ?self
    {
        $this->uniqIdContact = $uniqIdContact;

        return $this;
    }

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeInterface $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    public function getSalesperson(): ?Salesperson
    {
        return $this->salesperson;
    }

    public function setSalesperson(?Salesperson $salesperson): self
    {
        $this->salesperson = $salesperson;

        return $this;
    }

    public function getOperation(): ?Operations
    {
        return $this->operation;
    }

    public function setOperation(?Operations $operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    public function getContacts(): ?Contacts
    {
        return $this->contacts;
    }

    public function setContacts(?Contacts $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }



    /**
     * Get the value of state
     *
     * @return  int
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @param  int  $state
     *
     * @return  self
     */ 
    public function setState(int $state)
    {
        $this->state = $state;

        return $this;
    }
}
