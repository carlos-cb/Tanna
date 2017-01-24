<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 */
class Product
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
    private $productNameEs;

    /**
     * @var string
     */
    private $productNameEn;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $foto;

    /**
     * @var boolean
     */
    private $isNew;

    /**
     * @var boolean
     */
    private $isShow;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $colors;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sizes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $fotodetalles;

    /**
     * @var \ShopBundle\Entity\Category
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->colors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sizes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fotodetalles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set productNameEs
     *
     * @param string $productNameEs
     * @return Product
     */
    public function setProductNameEs($productNameEs)
    {
        $this->productNameEs = $productNameEs;

        return $this;
    }

    /**
     * Get productNameEs
     *
     * @return string 
     */
    public function getProductNameEs()
    {
        return $this->productNameEs;
    }

    /**
     * Set productNameEn
     *
     * @param string $productNameEn
     * @return Product
     */
    public function setProductNameEn($productNameEn)
    {
        $this->productNameEn = $productNameEn;

        return $this;
    }

    /**
     * Get productNameEn
     *
     * @return string 
     */
    public function getProductNameEn()
    {
        return $this->productNameEn;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
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
     * Set foto
     *
     * @param string $foto
     * @return Product
     */
    public function setFoto($foto)
    {
        if(!empty($foto)){
            $this->foto = $foto;
        }

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set isNew
     *
     * @param boolean $isNew
     * @return Product
     */
    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;

        return $this;
    }

    /**
     * Get isNew
     *
     * @return boolean 
     */
    public function getIsNew()
    {
        return $this->isNew;
    }

    /**
     * Set isShow
     *
     * @param boolean $isShow
     * @return Product
     */
    public function setIsShow($isShow)
    {
        $this->isShow = $isShow;

        return $this;
    }

    /**
     * Get isShow
     *
     * @return boolean 
     */
    public function getIsShow()
    {
        return $this->isShow;
    }

    /**
     * Add colors
     *
     * @param \ShopBundle\Entity\Color $colors
     * @return Product
     */
    public function addColor(\ShopBundle\Entity\Color $colors)
    {
        $this->colors[] = $colors;

        return $this;
    }

    /**
     * Remove colors
     *
     * @param \ShopBundle\Entity\Color $colors
     */
    public function removeColor(\ShopBundle\Entity\Color $colors)
    {
        $this->colors->removeElement($colors);
    }

    /**
     * Get colors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * Add sizes
     *
     * @param \ShopBundle\Entity\Size $sizes
     * @return Product
     */
    public function addSize(\ShopBundle\Entity\Size $sizes)
    {
        $this->sizes[] = $sizes;

        return $this;
    }

    /**
     * Remove sizes
     *
     * @param \ShopBundle\Entity\Size $sizes
     */
    public function removeSize(\ShopBundle\Entity\Size $sizes)
    {
        $this->sizes->removeElement($sizes);
    }

    /**
     * Get sizes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * Add fotodetalles
     *
     * @param \ShopBundle\Entity\Fotodetalle $fotodetalles
     * @return Product
     */
    public function addFotodetalle(\ShopBundle\Entity\Fotodetalle $fotodetalles)
    {
        $this->fotodetalles[] = $fotodetalles;

        return $this;
    }

    /**
     * Remove fotodetalles
     *
     * @param \ShopBundle\Entity\Fotodetalle $fotodetalles
     */
    public function removeFotodetalle(\ShopBundle\Entity\Fotodetalle $fotodetalles)
    {
        $this->fotodetalles->removeElement($fotodetalles);
    }

    /**
     * Get fotodetalles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFotodetalles()
    {
        return $this->fotodetalles;
    }

    /**
     * Set category
     *
     * @param \ShopBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\ShopBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \ShopBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function __toString() {
        return strval($this->id);
    }
    /**
     * @var float
     */
    private $priceA;


    /**
     * Set priceA
     *
     * @param float $priceA
     * @return Product
     */
    public function setPriceA($priceA)
    {
        $this->priceA = $priceA;

        return $this;
    }

    /**
     * Get priceA
     *
     * @return float 
     */
    public function getPriceA()
    {
        return $this->priceA;
    }
    /**
     * @var boolean
     */
    private $isSale;

    /**
     * @var float
     */
    private $discountPrice;

    /**
     * @var float
     */
    private $discountPriceA;

    /**
     * @var boolean
     */
    private $isOferta;

    /**
     * @var integer
     */
    private $maiUnit;

    /**
     * @var integer
     */
    private $suanUnit;


    /**
     * Set isSale
     *
     * @param boolean $isSale
     * @return Product
     */
    public function setIsSale($isSale)
    {
        $this->isSale = $isSale;

        return $this;
    }

    /**
     * Get isSale
     *
     * @return boolean 
     */
    public function getIsSale()
    {
        return $this->isSale;
    }

    /**
     * Set discountPrice
     *
     * @param float $discountPrice
     * @return Product
     */
    public function setDiscountPrice($discountPrice)
    {
        $this->discountPrice = $discountPrice;

        return $this;
    }

    /**
     * Get discountPrice
     *
     * @return float 
     */
    public function getDiscountPrice()
    {
        return $this->discountPrice;
    }

    /**
     * Set discountPriceA
     *
     * @param float $discountPriceA
     * @return Product
     */
    public function setDiscountPriceA($discountPriceA)
    {
        $this->discountPriceA = $discountPriceA;

        return $this;
    }

    /**
     * Get discountPriceA
     *
     * @return float 
     */
    public function getDiscountPriceA()
    {
        return $this->discountPriceA;
    }

    /**
     * Set isOferta
     *
     * @param boolean $isOferta
     * @return Product
     */
    public function setIsOferta($isOferta)
    {
        $this->isOferta = $isOferta;

        return $this;
    }

    /**
     * Get isOferta
     *
     * @return boolean 
     */
    public function getIsOferta()
    {
        return $this->isOferta;
    }

    /**
     * Set maiUnit
     *
     * @param integer $maiUnit
     * @return Product
     */
    public function setMaiUnit($maiUnit)
    {
        $this->maiUnit = $maiUnit;

        return $this;
    }

    /**
     * Get maiUnit
     *
     * @return integer 
     */
    public function getMaiUnit()
    {
        return $this->maiUnit;
    }

    /**
     * Set suanUnit
     *
     * @param integer $suanUnit
     * @return Product
     */
    public function setSuanUnit($suanUnit)
    {
        $this->suanUnit = $suanUnit;

        return $this;
    }

    /**
     * Get suanUnit
     *
     * @return integer 
     */
    public function getSuanUnit()
    {
        return $this->suanUnit;
    }
}
