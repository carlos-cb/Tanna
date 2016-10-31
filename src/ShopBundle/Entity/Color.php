<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Color
 */
class Color
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
    private $colorFoto;

    /**
     * @var string
     */
    private $colorNameEs;

    /**
     * @var string
     */
    private $colorNameEn;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $fotodetalles;

    /**
     * @var \ShopBundle\Entity\Product
     */
    private $product;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fotodetalles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set colorFoto
     *
     * @param string $colorFoto
     * @return Color
     */
    public function setColorFoto($colorFoto)
    {
        if(!empty($colorFoto)) {
            $this->colorFoto = $colorFoto;
        }

        return $this;
    }

    /**
     * Get colorFoto
     *
     * @return string 
     */
    public function getColorFoto()
    {
        return $this->colorFoto;
    }

    /**
     * Set colorNameEs
     *
     * @param string $colorNameEs
     * @return Color
     */
    public function setColorNameEs($colorNameEs)
    {
        $this->colorNameEs = $colorNameEs;

        return $this;
    }

    /**
     * Get colorNameEs
     *
     * @return string 
     */
    public function getColorNameEs()
    {
        return $this->colorNameEs;
    }

    /**
     * Set colorNameEn
     *
     * @param string $colorNameEn
     * @return Color
     */
    public function setColorNameEn($colorNameEn)
    {
        $this->colorNameEn = $colorNameEn;

        return $this;
    }

    /**
     * Get colorNameEn
     *
     * @return string 
     */
    public function getColorNameEn()
    {
        return $this->colorNameEn;
    }

    /**
     * Add fotodetalles
     *
     * @param \ShopBundle\Entity\Fotodetalle $fotodetalles
     * @return Color
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
     * Set product
     *
     * @param \ShopBundle\Entity\Product $product
     * @return Color
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
