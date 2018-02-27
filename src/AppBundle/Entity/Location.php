<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="locations")
 */
class Location
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $__pk;
    
    /**
     * @var string
     * @ORM\Column(name="location_name")
     */
    public $location_name;
    
   
}