<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
class Ingredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Recipes::class, inversedBy: 'ingredients')]
    private Collection $recipe_id;

    #[ORM\Column(length: 255)]
    private ?string $quantity = null;

    public function __construct()
    {
        $this->recipe_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Recipes>
     */
    public function getRecipeId(): Collection
    {
        return $this->recipe_id;
    }

    public function addRecipeId(Recipes $recipeId): static
    {
        if (!$this->recipe_id->contains($recipeId)) {
            $this->recipe_id->add($recipeId);
        }

        return $this;
    }

    public function removeRecipeId(Recipes $recipeId): static
    {
        $this->recipe_id->removeElement($recipeId);

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
