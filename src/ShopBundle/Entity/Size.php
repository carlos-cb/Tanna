<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Size
 */
class Size
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
    private $sizeName;

    /**
     * @var \ShopBundle\Entity\Product
     */
    private $product;


    /**
     * Set sizeName
     *
     * @param string $sizeName
     * @return Size
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
     * Set product
     *
     * @param \ShopBundle\Entity\Product $product
     * @return Size
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
