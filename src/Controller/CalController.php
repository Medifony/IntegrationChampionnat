<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalController extends AbstractController
{
    /**
     * @Route("/calendrier/{page<\d+>?1}", name="calpage")
     */
    public function index(CalendrierRepository $repoCal, $page)
    {
        
        return $this->render('cal/index.html.twig', [
            'cals' => $repoCal->findBy(array('journee' => $page), array('calDate' => 'asc')),
            'pages' => $repoCal->findPages(),
            'page' => $page
        ]);
    }     
}
