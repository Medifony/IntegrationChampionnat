<?php

namespace App\Controller;

use App\Entity\StatsJoueur;
use App\Form\StatsJoueurType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminStatsJoueurController extends AbstractController
{
    /**
     * @Route("/admin/statsjoueurs/new", name="admin_statsjoueurs_create")
     */
    public function index(ObjectManager $manager, Request $request) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $statsJoueur = new StatsJoueur();

        $form = $this->createForm(StatsJoueurType::class, $statsJoueur);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            $manager->persist($statsJoueur);
            $manager->flush();

            $this->addFlash(
                'success',
                "La stat du joueur <strong>{$statsJoueur->getJoueurs()->getPrenom()}</strong> 
                <strong>{$statsJoueur->getJoueurs()->getNom()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_statsjoueurs_create');
        }

        return $this->render('admin/statsJoueurs/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/statsjoueurs/{id}/edit", name="admin_statsjoueurs_edit")
     */
    public function edit(StatsJoueur $statsJoueur, Request $request, ObjectManager $manager){
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

        return $this->render('admin/statsJoueurs/edit.html.twig', [
            'stJou' => $statsJoueur,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/statsjoueurs/{id}/delete", name="admin_statsjoueurs_delete")
     */
    public function delete(StatsJoueur $statsJoueur, ObjectManager $manager){
        $manager->remove($statsJoueur);
        $manager->flush();

        $this->addFlash(
            'success',
            "La stat du joueur <strong>{$statsJoueur->getJoueurs()->getPrenom()}</strong>
             <strong>{$statsJoueur->getJoueurs()->getNom()}</strong> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_statsjoueurs_index');
    }
}
