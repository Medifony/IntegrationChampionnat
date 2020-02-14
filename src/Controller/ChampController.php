<?php

namespace App\Controller;

use App\Repository\EquipeRepository;
use App\Repository\CalendrierRepository;
use App\Repository\ClassementRepository;
use App\Repository\DescriptionRepository;
use App\Repository\StatsJoueurRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChampController extends AbstractController
{
    /** 
     * @Route("/", name="homepage") 
     */
    public function home(DescriptionRepository $repoDescr, EquipeRepository $repoEq, CalendrierRepository $repoCal, ClassementRepository $repoClass, 
    StatsJoueurRepository $repoStJouB, StatsJoueurRepository $repoStJouP){

        $equipes = $repoEq->findAll();

        $cals = $repoCal->findBy([], array('calDate' => 'asc'));

        $classs = $repoClass->findBy([], array('points' => 'desc'), 5, 0);

        
        return $this->render('champ/home.html.twig', [
            'equipes' => $equipes,
            'cals' => $cals,
            'classs' => $classs,
            'stJousB' => $repoStJouB->findBestScorers(5),
            'stJousP' => $repoStJouP->findBestPassers(5),
            'description' => $repoDescr->findAll()
        ]);
    }
}
