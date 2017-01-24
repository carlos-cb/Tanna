<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Globals
 */
class Globals
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
     * @var float
     */
    private $man;

    /**
     * @var float
     */
    private $jian;


    /**
     * Set man
     *
     * @param float $man
     * @return Globals
     */
    public function setMan($man)
    {
        $this->man = $man;

        return $this;
    }

    /**
     * Get man
     *
     * @return float 
     */
    public function getMan()
    {
        return $this->man;
    }

    /**
     * Set jian
     *
     * @param float $jian
     * @return Globals
     */
    public function setJian($jian)
    {
        $this->jian = $jian;

        return $this;
    }

    /**
     * Get jian
     *
     * @return float 
     */
    public function getJian()
    {
        return $this->jian;
    }
}
