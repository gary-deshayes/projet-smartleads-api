<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Behavior
 *
 * @ORM\Table(name="behavior")
 * @ORM\Entity
 */
class Behavior
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


}
