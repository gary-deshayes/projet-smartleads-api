<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Turnovers
 *
 * @ORM\Table(name="turnovers")
 * @ORM\Entity
 */
class Turnovers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=false)
     */
    private $libelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Company", mappedBy="idTurnovers")
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
