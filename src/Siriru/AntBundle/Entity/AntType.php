<?php

namespace Siriru\AntBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Siriru\AntBundle\Entity\AntType
 *
 * @ORM\Table(name="ant_ant_types")
 * @ORM\Entity(repositoryClass="Siriru\AntBundle\Repository\AntTypeRepository")
 */
class AntType
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
}