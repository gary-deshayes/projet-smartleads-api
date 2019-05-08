<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity
 */
class Country
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=2, nullable=false)
     * @ORM\Id
     * @Assert\Length(
     *      max = 2,
     *      maxMessage = "Le code ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=false)
     * * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le code ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $libelle;

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }



    /**
     * Get the value of code
     *
     * @return  string
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @param  string  $code
     *
     * @return  self
     */ 
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }
}
