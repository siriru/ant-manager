<?php

namespace Siriru\AntBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Siriru\AntBundle\Entity\Ant
 *
 * @ORM\Table(name="ant_ants")
 * @ORM\Entity(repositoryClass="Siriru\AntBundle\Repository\AntRepository")
 */
class Ant
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="AntType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $type;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $quantity;
}