<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
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
    private $nomIngredient;

    /**
     * @ORM\ManyToMany(targetEntity=Composition::class, inversedBy="ingredients")
     */
    private $compositionIngredients;

    public function __construct()
    {
        $this->compositionIngredients = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomIngredient(): ?string
    {
        return $this->nomIngredient;
    }

    public function setNomIngredient(string $nomIngredient): self
    {
        $this->nomIngredient = $nomIngredient;

        return $this;
    }

    /**
     * @return Collection|Composition[]
     */
    public function getCompositionIngredients(): Collection
    {
        return $this->compositionIngredients;
    }

    public function addCompositionIngredient(Composition $compositionIngredient): self
    {
        if (!$this->compositionIngredients->contains($compositionIngredient)) {
            $this->compositionIngredients[] = $compositionIngredient;
        }

        return $this;
    }

    public function removeCompositionIngredient(Composition $compositionIngredient): self
    {
        $this->compositionIngredients->removeElement($compositionIngredient);

        return $this;
    }



}
