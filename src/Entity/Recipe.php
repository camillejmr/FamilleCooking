<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le nom de la recette doit contenir au moins 5 caractères")
     * @Assert\Length(max="255")
     * @Assert\Length(min="3")
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Assert\NotBlank(message="La description de la recette doit contenir au moins 10 caractères")
     * @Assert\Length(max="1000")
     * @Assert\Length(min="10")
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=Composition::class, mappedBy="recipe", cascade={"persist", "remove"})
     */
    private $composition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $preparationTime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cookingTime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $restTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $totalTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quantity;


    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getComposition(): ?Composition
    {
        return $this->composition;
    }

    public function setComposition(Composition $composition): self
    {
        // set the owning side of the relation if necessary
        if ($composition->getRecipe() !== $this) {
            $composition->setRecipe($this);
        }

        $this->composition = $composition;

        return $this;
    }

    public function getPreparationTime(): ?string
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(string $preparationTime): self
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getCookingTime(): ?string
    {
        return $this->cookingTime;
    }

    public function setCookingTime(?string $cookingTime): self
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    public function getRestTime(): ?string
    {
        return $this->restTime;
    }

    public function setRestTime(?string $restTime): self
    {
        $this->restTime = $restTime;

        return $this;
    }

    public function getTotalTime(): ?string
    {
        return $this->totalTime;
    }

    public function setTotalTime(string $totalTime): self
    {
        $this->totalTime = $totalTime;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }


    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }


}
