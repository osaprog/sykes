<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\SearchType;
use AppBundle\Entity\Property;

class DefaultController extends Controller {

 
    /**
     * @Route("/", name="search")
     */
    public function indexAction(Request $request) {
        
        $pagination = null;
        $form = $this->createForm(SearchType::class, null, array(
            'method' => 'get'
        ));
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $query = $this->getDoctrine()
                    ->getRepository(Property::class)
                    ->search($request->get('search'));
 
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                2/*limit per page*/
            );    

        }
        
    
        return $this->render(
                        "default/index.html.twig", array('form' => $form->createView(),
                    'pagination' => $pagination,
        ));
    }

}
