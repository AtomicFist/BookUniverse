<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SellerRepository")
 */
class Seller
{

    //--------------------- PROPERTIES ---------------------//

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id_seller", type="integer")
     */
    private $idSeller;

    /**
     * @ORM\Column(name="seller_name", type="string", length=16)
     */
    private $sellerName;

    /**
     * @ORM\Column(name="seller_url", type="string", length=255)
     */
    private $sellerURL;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Book", mappedBy="seller")
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }


    //---------------------- METHODS -----------------------//

    public function getIdSeller()
    {
        return $this->idSeller;
    }

    public function getSellerName(): ?string
    {
        return $this->sellerName;
    }

    public function setSellerName(string $sellerName): self
    {
        $this->sellerName = $sellerName;

        return $this;
    }

    public function getSellerURL(): ?string
    {
        return $this->sellerURL;
    }

    public function setSellerURL(string $sellerURL): self
    {
        $this->sellerURL = $sellerURL;

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
            $book->setSeller($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            // set the owning side to null (unless already changed)
            if ($book->getSeller() === $this) {
                $book->setSeller(null);
            }
        }

        return $this;
    }
}
