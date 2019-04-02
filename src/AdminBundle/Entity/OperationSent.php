<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperationSent
 *
 * @ORM\Table(name="operation_sent", indexes={@ORM\Index(name="id_contacts", columns={"id_contacts"}), @ORM\Index(name="id_operation", columns={"id_operation"}), @ORM\Index(name="IDX_95B4773850B241AB", columns={"id_salesperson"})})
 * @ORM\Entity
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
    private $idSalesperson;

    /**
     * @var \Operations
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Operations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_operation", referencedColumnName="name")
     * })
     */
    private $idOperation;

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
    private $idContacts;

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeInterface $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    public function getIdSalesperson(): ?Salesperson
    {
        return $this->idSalesperson;
    }

    public function setIdSalesperson(?Salesperson $idSalesperson): self
    {
        $this->idSalesperson = $idSalesperson;

        return $this;
    }

    public function getIdOperation(): ?Operations
    {
        return $this->idOperation;
    }

    public function setIdOperation(?Operations $idOperation): self
    {
        $this->idOperation = $idOperation;

        return $this;
    }

    public function getIdContacts(): ?Contacts
    {
        return $this->idContacts;
    }

    public function setIdContacts(?Contacts $idContacts): self
    {
        $this->idContacts = $idContacts;

        return $this;
    }


}
