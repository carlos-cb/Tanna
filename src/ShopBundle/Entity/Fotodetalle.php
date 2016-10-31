<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fotodetalle
 */
class Fotodetalle
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
    private $fotodetalle;

    /**
     * @var string
     */
    private $descriptionEs;

    /**
     * @var string
     */
    private $descriptionEn;

    /**
     * @var \ShopBundle\Entity\Product
     */
    private $product;

    /**
     * @var \ShopBundle\Entity\Color
     */
    private $color;


    /**
     * Set fotodetalle
     *
     * @param string $fotodetalle
     * @return Fotodetalle
     */
    public function setFotodetalle($fotodetalle)
    {
        if(!empty($fotodetalle)) {
            $this->fotodetalle = $fotodetalle;
        }

        return $this;
    }

    /**
     * Get fotodetalle
     *
     * @return string 
     */
    public function getFotodetalle()
    {
        return $this->fotodetalle;
    }

    /**
     * Set descriptionEs
     *
     * @param string $descriptionEs
     * @return Fotodetalle
     */
    public function setDescriptionEs($descriptionEs)
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * Get descriptionEs
     *
     * @return string 
     */
    public function getDescriptionEs()
    {
        return $this->descriptionEs;
    }

    /**
     * Set descriptionEn
     *
     * @param string $descriptionEn
     * @return Fotodetalle
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * Get descriptionEn
     *
     * @return string 
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * Set product
     *
     * @param \ShopBundle\Entity\Product $product
     * @return Fotodetalle
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

    /**
     * Set color
     *
     * @param \ShopBundle\Entity\Color $color
     * @return Fotodetalle
     */
    public function setColor(\ShopBundle\Entity\Color $color = null)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return \ShopBundle\Entity\Color 
     */
    public function getColor()
    {
        return $this->color;
    }

    public function __toString() {
        return strval($this->id);
    }
}
