<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperationSent
 *
 * @ORM\Table(name="operation_sent", indexes={@ORM\Index(name="id_contacts", columns={"id_contacts"}), @ORM\Index(name="id_operation_", columns={"id_operation_"}), @ORM\Index(name="IDX_95B4773850B241AB", columns={"id_salesperson"})})
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
     *   @ORM\JoinColumn(name="id_operation_", referencedColumnName="name")
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


}
