<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */


class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string") */
    private $description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


    /**
     * @ORM\Column(type="string") */
    private $image;






    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products") * @ORM\JoinColumn(nullable=true)
     */
    private $category;

    // allow null - ?Category vs Category
    public function getCategory(): ?Category {
        return $this->category;
    }

    // default Category to null
    public function setCategory(Category $category = null) {
        $this->category = $category;
    }

    public function __toString()
    {
        return $this->id . ': ' . $this->getDescription();
    }




    /** /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="product")
     */
    private $reviews;

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews): void
    {
        $this->reviews = $reviews;
    }

    public function __construct() {

        $this->reviews = new ArrayCollection();
    }





    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Price", inversedBy="products") * @ORM\JoinColumn(nullable=true)
     */
    private $price;

    // allow null - ?Price vs Price
    public function getPrice(): ?Price {
        return $this->price;
    }

    // default Category to null
    public function setPrice(Price $price = null) {
        $this->price = $price;
    }

}


