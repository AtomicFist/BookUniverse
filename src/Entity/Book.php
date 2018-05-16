<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{

    //--------------------- PROPERTIES ---------------------//

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id_book", type="integer")
     */
    private $idBook;

    /**
     * @ORM\Column(name="ISBN", type="string", length=13)
     */
    private $isbn;

    /**
     * @ORM\Column(name="title",type="string", length=32)
     */
    private $title;

    /**
     * @ORM\Column(name="author", type="string", length=56)
     */
    private $author;

    /**
     * @ORM\Column(name="editor", type="string", length=24)
     */
    private $editor;

    /**
     * @ORM\Column(name="published_at", type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="nb_page", type="integer", nullable=true)
     */
    private $nbPage;

    /**
     * @ORM\Column(name="size", type="string", length=24, nullable=true)
     */
    private $size;

    /**
     * @ORM\Column(name="weight", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="books")
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id_category", nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seller", inversedBy="books")
     * @ORM\JoinColumn(name="id_seller", referencedColumnName="id_seller")
     */
    private $seller;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Feedback", inversedBy="books")
     * @ORM\JoinColumn(name="id_feedback", referencedColumnName="id_feedback")
     */
    private $feedback;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="booksLibraryPossessed")
     * @ORM\JoinTable(name="library_possessed",
     *     joinColumns={@ORM\JoinColumn(name="id_book", referencedColumnName="id_book")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="id_user", referencedColumnName="id_user")}
     *     )
     */
    private $usersLibraryPossessed;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="booksLibraryDesired")
     * @ORM\JoinTable(name="library_desired",
     *     joinColumns={@ORM\JoinColumn(name="id_book", referencedColumnName="id_book")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="id_user", referencedColumnName="id_user")}
     *     )
     */
    private $usersLibraryDesired;


    //---------------------- METHODS -----------------------//

    public function __construct()
    {
        $this->usersLibraryPossessed = new ArrayCollection();
        $this->usersLibraryDesired = new ArrayCollection();
    }

    public function getIdBook()
    {
        return $this->idBook;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getEditor(): ?string
    {
        return $this->editor;
    }

    public function setEditor(string $editor): self
    {
        $this->editor = $editor;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

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

    public function getNbPage(): ?int
    {
        return $this->nbPage;
    }

    public function setNbPage(?int $nbPage): self
    {
        $this->nbPage = $nbPage;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight): self
    {
        $this->weight = $weight;

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

    public function getSeller(): ?Seller
    {
        return $this->seller;
    }

    public function setSeller(?Seller $seller): self
    {
        $this->seller = $seller;

        return $this;
    }

    public function getFeedback(): ?Feedback
    {
        return $this->feedback;
    }

    public function setFeedback(?Feedback $feedback): self
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsersLibraryPossessed(): Collection
    {
        return $this->usersLibraryPossessed;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsersLibraryDesired(): Collection
    {
        return $this->usersLibraryDesired;
    }

}
