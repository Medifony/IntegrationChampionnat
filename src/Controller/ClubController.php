<?php

namespace App\Controller;

use App\Repository\EquipeRepository;
use App\Repository\JoueurRepository;
use App\Repository\CalendrierRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClubController extends AbstractController
{
    /**
     * @Route("/equipes/{slug}", name="club")
     */
    public function index($slug, CalendrierRepository $repoCal, EquipeRepository $repoEqu, JoueurRepository $repoJous)
    {
        $equ = $repoEqu->findOneBySlug($slug);

        return $this->render('club/index.html.twig', [
            'cals' => $repoCal->findClub($slug),
            'equ' => $equ,
            'jous' => $repoJous->findPlayers($slug)
        ]);
    }
    
    /** 
     * @Route("/equipes", name="equipespage") 
     */
    public function equipes(EquipeRepository $repoEq){

        $eq = $repoEq->findall();

        return $this->render('club/equipes.html.twig', [
            'eq' => $eq
        ]);
    }
}
