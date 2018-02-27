<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bookings")
 */
class Booking
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $__pk;
    
     /**
     * @var int
     *
     * @ORM\Column(name="_fk_property")
     * 
     */
    protected $_fk_property;
    
     /**
     * @var date
     *
     * @ORM\Column(name="start_date")
     * 
     */
    protected $start_date; 

     /**
     * @var date
     *
     * @ORM\Column(name="end_date")
     * 
     */
    protected $end_date;
}