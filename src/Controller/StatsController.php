<?php

namespace App\Controller;

use App\Repository\RencontreRepository;
use App\Repository\StatsEquipeRepository;
use App\Repository\JoueRencontreRepository;
use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends AbstractController
{
    /**
     * @Route("/stats/{slug}", name="statspage")
     */
    public function index($slug, RencontreRepository $repoRenc, StatsEquipeRepository $repoStEq, 
            JoueRencontreRepository $repoJRenc, CalendrierRepository $repoCal)
    {
        $renc = $repoRenc->findOneBySlug($slug);
        $cal = $repoCal->findOneByRencontres($renc);
        $jRenc = $repoJRenc->findBy(
                array('rencontres'=> $renc), 
                array('titRem' => 'DESC'));

        return $this->render('stats/index.html.twig', [
            'renc' => $renc,
            'cal' => $cal,
            'jRenc' => $jRenc
        ]);
    }
}
