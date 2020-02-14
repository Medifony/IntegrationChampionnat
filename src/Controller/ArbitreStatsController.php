<?php

namespace App\Controller;

use App\Entity\Rencontre;
use App\Entity\StatsEquipe;
use App\Entity\StatsJoueur;
use App\Form\RencontreType;
use App\Form\StatsEquipeType;
use App\Form\StatsJoueurType;
use App\Repository\StatsEquipeRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArbitreStatsController extends AbstractController
{
    /**
     * @Route("/arbitre/statsequipes/{id}/edit", name="arbitre_statsequipes_edit")
     */
    public function editEq(StatsEquipe $statsEquipe, Request $request, ObjectManager $manager){
        $form = $this->createForm(StatsEquipeType::class, $statsEquipe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($statsEquipe);
            $manager->flush();

            $this->addFlash(
                'success',
                "La stat de l'équipe <strong>{$statsEquipe->getEquipes()->getNom()}</strong> a bien été enregistrée"
            );
        }

        return $this->render('arbitre/stequipes.html.twig', [
            'stEq' => $statsEquipe,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/arbitre/statsjoueurs/{id}/edit", name="arbitre_statsjoueurs_edit")
     */
    public function editJou(StatsJoueur $statsJoueur, Request $request, ObjectManager $manager){
        $form = $this->createForm(StatsJoueurType::class, $statsJoueur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($statsJoueur);
            $manager->flush();

            $this->addFlash(
                'success',
                "La stat du joueur <strong>{$statsJoueur->getJoueurs()->getPrenom()}</strong> 
                <strong>{$statsJoueur->getJoueurs()->getNom()}</strong> a bien été enregistrée"
            );
        }

        return $this->render('arbitre/stjoueurs.html.twig', [
            'stJou' => $statsJoueur,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/arbitre/rencontres/{id}/edit", name="arbitre_rencontres_edit")
     */
    public function edit(Rencontre $rencontre, Request $request, ObjectManager $manager, StatsEquipeRepository $repoStEq){
        $form = $this->createForm(RencontreType::class, $rencontre);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if( $rencontre->getStatut() != "En attente")
            {
               $stEquipes = $repoStEq->findByRencontres($rencontre);
               
                if($stEquipes[0]->getEquipes()->getId() == $rencontre->getEquipesD()->getId()){
                    $statsD = $stEquipes[0];
                    $statsE = $stEquipes[1];
                }
                else
                {
                    $statsD = $stEquipes[1];
                    $statsE = $stEquipes[0];
                }
                $rencontre->setStatsEqD($statsD);
                $rencontre->setStatsEqE($statsE);
            }

            $manager->persist($rencontre);
            $manager->flush();

            $this->addFlash(
                'success',
                "La rencontre <strong>{$rencontre->getSlug()}</strong> a bien été enregistrée"
            );
        }

        return $this->render('arbitre/renc.html.twig', [
            'renc' => $rencontre,
            'form' => $form->createView()
        ]);
    }
}
