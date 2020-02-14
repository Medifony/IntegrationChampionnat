<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Joueur;
use App\Entity\Rencontre;
use App\Entity\Calendrier;
use App\Entity\StatsEquipe;
use App\Entity\StatsJoueur;
use App\Entity\JoueRencontre;
use App\Repository\UserRepository;
use App\Service\PaginationService;
use App\Repository\StadeRepository;
use App\Repository\EquipeRepository;
use App\Repository\JoueurRepository;
use App\Repository\RencontreRepository;
use App\Repository\CalendrierRepository;
use App\Repository\ClassementRepository;
use App\Repository\EntraineurRepository;
use App\Repository\DescriptionRepository;
use App\Repository\StatsEquipeRepository;
use App\Repository\StatsJoueurRepository;
use App\Repository\JoueRencontreRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminChampController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_description_index")
     */
    public function descriptionAdmin(DescriptionRepository $repoDescr)
    {
        return $this->render('admin/description/index.html.twig', [
            'descr' => $repoDescr->findAll()
        ]);
    }

    /**
     * @Route("/admin/equipes", name="admin_equipes_index")
     */
    public function equipesAdmin(EquipeRepository $repoEq)
    {
        return $this->render('admin/equipes/index.html.twig', [
            'eqs' => $repoEq->findAll()
        ]);
    }

    /**
     * @Route("/admin/entraineurs", name="admin_entraineurs_index")
     */
    public function entraineursAdmin(EntraineurRepository $repoEntr)
    {

        return $this->render('admin/entraineurs/index.html.twig', [
            'entrs' => $repoEntr->findAll()
        ]);
    }

    /**
     * @Route("/admin/stades", name="admin_stades_index")
     */
    public function stadesAdmin(StadeRepository $repoSta)
    {
        
        return $this->render('admin/stades/index.html.twig', [
            'stades' => $repoSta->findAll()
        ]);
    }

    /**
     * @Route("/admin/calendriers/{page<\d+>?1}", name="admin_calendriers_index")
     */
    public function calsAdmin(CalendrierRepository $repoCal, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Calendrier::class)
                   ->setPage($page);
        
        return $this->render('admin/calendriers/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/admin/rencontres/{page<\d+>?1}", name="admin_rencontres_index")
     */
    public function rencAdmin(RencontreRepository $repoRenc, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Rencontre::class)
                   ->setPage($page);
        
        return $this->render('admin/rencontres/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/admin/statsequipes/{page<\d+>?1}", name="admin_stequipes_index")
     */
    public function stEqAdmin(StatsEquipeRepository $repoStEq, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(StatsEquipe::class)
                   ->setPage($page);

        
        return $this->render('admin/statsEquipes/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/admin/joueurs/{page<\d+>?1}", name="admin_joueurs_index")
     */
    public function jousAdmin(JoueurRepository $repoJou, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Joueur::class)
                   ->setPage($page);

        return $this->render('admin/joueurs/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/admin/jouerenc/{page<\d+>?1}", name="admin_jouerencontres_index")
     */
    public function joueRencAdmin(JoueRencontreRepository $repoJoueRenc, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(JoueRencontre::class)
                   ->setPage($page);

        return $this->render('admin/joueRencontres/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/admin/classements", name="admin_classements_index")
     */
    public function classAdmin(ClassementRepository $repoClass)
    {
        return $this->render('admin/classements/index.html.twig', [
            'classs' => $repoClass->findAll()
        ]);
    }

    /**
     * @Route("/admin/statsjoueurs/{page<\d+>?1}", name="admin_statsjoueurs_index")
     */
    public function stJouAdmin(StatsJoueurRepository $repostJou, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(StatsJoueur::class)
                   ->setPage($page);

        return $this->render('admin/statsJoueurs/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/admin/utilisateurs/{page<\d+>?1}", name="admin_utilisateurs_index")
     */
    public function utilisateursAdmin(UserRepository $repoUt, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(User::class)
                   ->setPage($page);

        return $this->render('admin/utilisateurs/index.html.twig', [
            'pagination' => $pagination
        ]);
    }
}
