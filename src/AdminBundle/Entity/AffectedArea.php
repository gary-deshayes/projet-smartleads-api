<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Beelab\TagBundle\Tag\TagInterface;
use Beelab\TagBundle\Tag\TaggableInterface;


/**
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\AffectedAreaRepository")
 */
class AffectedArea implements TaggableInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * Une zone a plusieurs départements
     * @OneToMany(targetEntity="Department", mappedBy="id")
     */
    private $departments;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function __construct()
    {
        $this->departments = new ArrayCollection();
    }

    public function addTag(TagInterface $department): void
    {
        if (!$this->departments->contains($department)) {
            $this->departments->add($department);
        }
    }

    public function removeTag(TagInterface $department): void
    {
        $this->departments->removeElement($department);
    }

    public function hasTag(TagInterface $department): bool
    {
        return $this->departments->contains($department);
    }

    public function getTags(): iterable
    {
        return $this->departments;
    }

    public function getTagNames(): array
    {
        return empty($this->tagsText) ? [] : \array_map('trim', explode(',', $this->tagsText));
    }
}
