<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="properties",  indexes={
 *     @ORM\Index(name="fk_location_idx", columns={"_fk_location"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PropertyRepository")
 */
 
class Property
{
 
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $__pk;
    
    /**
     * @ORM\Column(name="property_name")
     */    
    protected $property_name;
    
    /**
     * @ORM\Column(name="near_beach")
     */    
    protected $near_beach;

    /**
     * @ORM\Column(name="sleeps")
     */    
    protected $sleeps;

    /**
     * @ORM\Column(name="beds")
     */    
    protected $beds;
    
     /**
     * @ORM\Column(name="_fk_location")
     */    
    protected $_fk_location;
    /**
     * @var Location
     *
     * @ORM\OneToOne(targetEntity="Location")
     * @ORM\JoinColumn(name="_fk_location", referencedColumnName="__pk")
     */
    protected $location; 
    
    /**
     * @ORM\Column(name="accepts_pets")
     */    
    protected $accepts_pets;    
    
    public function setName($name){
       $this->property_name = $name; 
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getName(){
       return $this->property_name; 
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getLocation(){
        return $this->location;
    }
}
