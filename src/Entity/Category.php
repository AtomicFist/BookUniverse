<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{

    //--------------------- PROPERTIES ---------------------//

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id_category", type="integer")
     */
    private $idCategory;

    /**
     * @ORM\Column(name="category_name", type="string", length=16)
     */
    private $categoryName;

    /**
     * @ORM\Column(name="sub_category_name", type="string", length=16)
     */
    private $subCategoryName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Book", mappedBy="category")
     */
    private $books;


    //---------------------- METHODS -----------------------//

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getIdCategory()
    {
        return $this->idCategory;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    public function getSubCategoryName(): ?string
    {
        return $this->subCategoryName;
    }

    public function setSubCategoryName(string $subCategoryName): self
    {
        $this->subCategoryName = $subCategoryName;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setCategory($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            // set the owning side to null (unless already changed)
            if ($book->getCategory() === $this) {
                $book->setCategory(null);
            }
        }

        return $this;
    }
}
