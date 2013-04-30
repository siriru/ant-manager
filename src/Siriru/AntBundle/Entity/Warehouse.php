<?php

namespace Siriru\AntBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Siriru\AntBundle\Entity\Warehouse
 *
 * @ORM\Table(name="ant_warehouses")
 * @ORM\Entity(repositoryClass="Siriru\AntBundle\Repository\WarehouseRepository")
 */
class Warehouse
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $capacity;

    /**
     * @ORM\OneToOne(targetEntity="Colony")
     * @ORM\JoinColumn(name="colony_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $colony;

    public function __construct($capacity = 20)
    {
        $this->capacity = $capacity;
    }

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
     * Set capacity
     *
     * @param integer $capacity
     * @return Warehouse
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    
        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer 
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set colony
     *
     * @param \Siriru\AntBundle\Entity\Colony $colony
     * @return Warehouse
     */
    public function setColony(\Siriru\AntBundle\Entity\Colony $colony = null)
    {
        $this->colony = $colony;
    
        return $this;
    }

    /**
     * Get colony
     *
     * @return \Siriru\AntBundle\Entity\Colony 
     */
    public function getColony()
    {
        return $this->colony;
    }
}