<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SearchType extends AbstractType {
 
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('location_name', TextType::class, array(
                    'label' => 'Location',
                    'mapped' => false,
                    'required' => false))
                ->add('near_beach', CheckboxType::class, array(
                    'label' => 'Near Beach',
                    'required' => false))
                ->add('accepts_pets', CheckboxType::class, array(
                    'label' => 'Accepts Pets',
                    'required' => false))
                ->add('sleeps', TextType::class, array(
                    'label' => 'Sleep',
                    'required' => false)
                )
                ->add('beds', TextType::class, array(
                    'label' => 'Beds',
                    'required' => false)
                )
                ->add('check_in', DateType::class, array(
                    'label' => 'Check In',
                    'required' => false)
                )
                ->add('check_out', DateType::class, array(
                    'label' => 'Check Out',
                    'required' => false)
                )
                ->add('beds', TextType::class, array(
                    'label' => 'Beds',
                    'required' => false)
                )
                ->add('Search', SubmitType::class)
        ;
    }

}
