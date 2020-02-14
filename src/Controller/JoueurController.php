<?php

namespace App\Controller;

use App\Repository\JoueurRepository;
use App\Repository\StatsJoueurRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JoueurController extends AbstractController
{
    /**
     * @Route("/joueur/{slug}", name="joueur")
     */
    public function index($slug, JoueurRepository $repoJou, StatsJoueurRepository $repoStJou)
    {
        $jou = $repoJou->findOneBySlug($slug);

        return $this->render('joueur/index.html.twig', [
            'jou' => $jou,
            'stJous' => $repoStJou->findSomme($slug),
        ]);
    }
}
