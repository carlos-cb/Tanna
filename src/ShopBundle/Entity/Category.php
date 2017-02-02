<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 */
class Category
{
    /**
     * @var int
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var string
     */
    private $categoryNameEs;

    /**
     * @var string
     */
    private $categoryNameEn;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set categoryNameEs
     *
     * @param string $categoryNameEs
     * @return Category
     */
    public function setCategoryNameEs($categoryNameEs)
    {
        $this->categoryNameEs = $categoryNameEs;

        return $this;
    }

    /**
     * Get categoryNameEs
     *
     * @return string 
     */
    public function getCategoryNameEs()
    {
        return $this->categoryNameEs;
    }

    /**
     * Set categoryNameEn
     *
     * @param string $categoryNameEn
     * @return Category
     */
    public function setCategoryNameEn($categoryNameEn)
    {
        $this->categoryNameEn = $categoryNameEn;

        return $this;
    }

    /**
     * Get categoryNameEn
     *
     * @return string 
     */
    public function getCategoryNameEn()
    {
        return $this->categoryNameEn;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add products
     *
     * @param \ShopBundle\Entity\Product $products
     * @return Category
     */
    public function addProduct(\ShopBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \ShopBundle\Entity\Product $products
     */
    public function removeProduct(\ShopBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    public function __toString() {
        return strval($this->id);
    }
    /**
     * @var integer
     */
    private $times;


    /**
     * Set times
     *
     * @param integer $times
     * @return Category
     */
    public function setTimes($times)
    {
        $this->times = $times;

        return $this;
    }

    /**
     * Get times
     *
     * @return integer 
     */
    public function getTimes()
    {
        return $this->times;
    }
}
