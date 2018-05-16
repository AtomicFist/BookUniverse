<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as UserBase;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends UserBase
{

    //--------------------- PROPERTIES ---------------------//

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id_user", type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Book", mappedBy="usersLibraryPossessed")
     */
    private $booksLibraryPossessed;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Book", mappedBy="usersLibraryDesired")
     */
    private $booksLibraryDesired;


    //---------------------- METHODS -----------------------//

    public function __construct()
    {
        parent::__construct();
        $this->booksLibraryPossessed = new ArrayCollection();
        $this->booksLibraryDesired = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooksLibraryPossessed(): Collection
    {
        return $this->booksLibraryPossessed;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooksLibraryDesired(): Collection
    {
        return $this->booksLibraryDesired;
    }

}
