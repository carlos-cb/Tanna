<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var int
     */
    protected $id;
    
    protected $isAutonomo;

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
     * @var \ShopBundle\Entity\Cart
     */
    private $cart;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orderInfos;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function __toString() {
        return strval($this->id);
    }
    /**
     * Set cart
     *
     * @param \ShopBundle\Entity\Cart $cart
     * @return User
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
     * Add orderInfos
     *
     * @param \ShopBundle\Entity\OrderInfo $orderInfos
     * @return User
     */
    public function addOrderInfo(\ShopBundle\Entity\OrderInfo $orderInfos)
    {
        $this->orderInfos[] = $orderInfos;

        return $this;
    }

    /**
     * Remove orderInfos
     *
     * @param \ShopBundle\Entity\OrderInfo $orderInfos
     */
    public function removeOrderInfo(\ShopBundle\Entity\OrderInfo $orderInfos)
    {
        $this->orderInfos->removeElement($orderInfos);
    }

    /**
     * Get orderInfos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderInfos()
    {
        return $this->orderInfos;
    }

    public function getOrderInfoSum()
    {
        $orderInfos = $this->orderInfos;
        $sum = 0;
        foreach($orderInfos as $orderInfo)
        {
            $sum += $orderInfo->getTotalPrice();
        }

        return $sum;
    }

    /**
     * Set isAutonomo
     *
     * @param boolean $isAutonomo
     * @return User
     */
    public function setIsAutonomo($isAutonomo)
    {
        $this->isAutonomo = $isAutonomo;

        return $this;
    }

    /**
     * Get isAutonomo
     *
     * @return boolean 
     */
    public function getIsAutonomo()
    {
        return $this->isAutonomo;
    }
    /**
     * @var array
     */
    protected $timesCategory;


    /**
     * Set timesCategory
     *
     * @param array $timesCategory
     * @return User
     */
    public function setTimesCategory($timesCategory)
    {
        $this->timesCategory = $timesCategory;

        return $this;
    }

    /**
     * Get timesCategory
     *
     * @return array 
     */
    public function getTimesCategory()
    {
        return $this->timesCategory;
    }

    public function getTimes()
    {
        $timesCategory = $this->timesCategory;
        $array = unserialize($timesCategory);

        return $array;
    }
}
