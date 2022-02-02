<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: Wish::class)]
    private $Wish;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Wish::class)]
    private $categories;

    public function __construct()
    {
        $this->Wish = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->getName();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|wish[]
     */
    public function getWish(): Collection
    {
        return $this->Wish;
    }

    public function addWish(wish $wish): self
    {
        if (!$this->Wish->contains($wish)) {
            $this->Wish[] = $wish;
            $wish->setCategories($this);
        }

        return $this;
    }

    public function removeWish(wish $wish): self
    {
        if ($this->Wish->removeElement($wish)) {
            // set the owning side to null (unless already changed)
            if ($wish->getCategories() === $this) {
                $wish->setCategories(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wish[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Wish $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setCategory($this);
        }

        return $this;
    }

    public function removeCategory(Wish $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategory() === $this) {
                $category->setCategory(null);
            }
        }

        return $this;
    }
}
