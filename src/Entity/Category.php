<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCategory;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="category")
     */
    private $categorie;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategory(): ?string
    {
        return $this->nomCategory;
    }

    public function setNomCategory(string $nomCategory): self
    {
        $this->nomCategory = $nomCategory;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Recipe $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->setCategory($this);
        }

        return $this;
    }

    public function removeCategorie(Recipe $categorie): self
    {
        if ($this->categorie->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getCategory() === $this) {
                $categorie->setCategory(null);
            }
        }

        return $this;
    }
}
