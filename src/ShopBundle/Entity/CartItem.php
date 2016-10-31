<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CartItem
 */
class CartItem
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
     * @var integer
     */
    private $quantity;

    /**
     * @var integer
     */
    private $colorId;

    /**
     * @var string
     */
    private $colorName;

    /**
     * @var string
     */
    private $sizeName;

    /**
     * @var string
     */
    private $foto;

    /**
     * @var \ShopBundle\Entity\Cart
     */
    private $cart;

    /**
     * @var \ShopBundle\Entity\Product
     */
    private $product;


    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return CartItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set colorId
     *
     * @param integer $colorId
     * @return CartItem
     */
    public function setColorId($colorId)
    {
        $this->colorId = $colorId;

        return $this;
    }

    /**
     * Get colorId
     *
     * @return integer 
     */
    public function getColorId()
    {
        return $this->colorId;
    }

    /**
     * Set colorName
     *
     * @param string $colorName
     * @return CartItem
     */
    public function setColorName($colorName)
    {
        $this->colorName = $colorName;

        return $this;
    }

    /**
     * Get colorName
     *
     * @return string 
     */
    public function getColorName()
    {
        return $this->colorName;
    }

    /**
     * Set sizeName
     *
     * @param string $sizeName
     * @return CartItem
     */
    public function setSizeName($sizeName)
    {
        $this->sizeName = $sizeName;

        return $this;
    }

    /**
     * Get sizeName
     *
     * @return string 
     */
    public function getSizeName()
    {
        return $this->sizeName;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return CartItem
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

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
     * Set cart
     *
     * @param \ShopBundle\Entity\Cart $cart
     * @return CartItem
     */
    public function setCart(\ShopBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return \ShopBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set product
     *
     * @param \ShopBundle\Entity\Product $product
     * @return CartItem
     */
    public function setProduct(\ShopBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \ShopBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    public function __toString() {
        return strval($this->id);
    }
}
