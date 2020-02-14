<?php

namespace App\Controller;

use App\Entity\StatsEquipe;
use App\Form\StatsEquipeType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminStatsEquipeController extends AbstractController
{
    /**
     * @Route("/admin/statsequipes/new", name="admin_statsequipes_create")
     */
    public function index(ObjectManager $manager, Request $request) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $stEquipe = new StatsEquipe();

        $form = $this->createForm(StatsEquipeType::class, $stEquipe);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            if($stEquipe->getEquipes()->getId() == $stEquipe->getRencontres()->getEquipesD()->getId()
               OR 
               $stEquipe->getEquipes()->getId() == $stEquipe->getRencontres()->getEquipesE()->getId())
            {
                $manager->persist($stEquipe);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "La stat de l'équipe <strong>{$stEquipe->getEquipes()->getNom()}</strong> a bien été enregistrée !"
                );
            }
            else
            {
                $this->addFlash(
                    'danger',
                    "L'équipe <strong>{$stEquipe->getEquipes()->getNom()}</strong> ne fait pas partie de la rencontre
                    <strong>{$stEquipe->getRencontres()->getSlug()}</strong> !"
                );
            }

            return $this->redirectToRoute('admin_statsequipes_create');
        }

        return $this->render('admin/statsEquipes/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/statsequipes/{id}/edit", name="admin_statsequipes_edit")
     */
    public function edit(StatsEquipe $stEquipe, Request $request, ObjectManager $manager){
        $form = $this->createForm(StatsEquipeType::class, $stEquipe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if($stEquipe->getEquipes()->getId() == $stEquipe->getRencontres()->getEquipesD()->getId()
               OR 
               $stEquipe->getEquipes()->getId() == $stEquipe->getRencontres()->getEquipesE()->getId())
            {
                $manager->persist($stEquipe);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "La stat de l'équipe <strong>{$stEquipe->getEquipes()->getNom()}</strong> a bien été enregistrée !"
                );
            }
            else
            {
                $this->addFlash(
                    'danger',
                    "L'équipe <strong>{$stEquipe->getEquipes()->getNom()}</strong> ne fait pas partie de la rencontre
                    <strong>{$stEquipe->getRencontres()->getSlug()}</strong> !"
                );
            }
        }
        return $this->render('admin/statsequipes/edit.html.twig', [
            'stEq' => $stEquipe,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/statsequipes/{id}/delete", name="admin_statsequipes_delete")
     */
    public function delete(StatsEquipe $statsEquipe, ObjectManager $manager){
        $manager->remove($statsEquipe);
        $manager->flush();

        $this->addFlash(
            'success',
            "La stat de l'équipe <strong>{$statsEquipe->getEquipes()->getNom()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_statsequipes_index');
    }
}
