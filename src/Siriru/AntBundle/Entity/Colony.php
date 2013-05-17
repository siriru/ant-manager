<?php

namespace Siriru\AntBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Siriru\AntBundle\Entity\Colony
 *
 * @ORM\Table(name="ant_colonies")
 * @ORM\Entity(repositoryClass="Siriru\AntBundle\Repository\ColonyRepository")
 */
class Colony
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank()
     */
    protected $name;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $capacity;
    
    /**
     * Birth rate per second
     * @ORM\Column(name="birth_rate", type="integer")
     */
    protected $birthRate;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    protected $user;

    public function __construct()
    {
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
     * Set name
     *
     * @param string $name
     * @return Colony
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user
     *
     * @param \Siriru\AntBundle\Entity\User $user
     * @return Colony
     */
    public function setUser(\Siriru\AntBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Siriru\AntBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     * @return Colony
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
     * Set birthRate
     *
     * @param integer $birthRate
     * @return Colony
     */
    public function setBirthRate($birthRate)
    {
        $this->birthRate = $birthRate;
    
        return $this;
    }

    /**
     * Get birthRate
     *
     * @return integer 
     */
    public function getBirthRate()
    {
        return $this->birthRate;
    }
}