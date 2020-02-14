<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Form\JoueurType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminJoueurController extends AbstractController
{
    /**
     * @Route("/admin/joueurs/new", name="admin_joueurs_create")
     */
    public function index(ObjectManager $manager, Request $request) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $joueur = new Joueur();

        $form = $this->createForm(JoueurType::class, $joueur);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            $manager->persist($joueur);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le joueur <strong>{$joueur->getPrenom()}</strong> <strong>{$joueur->getNom()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_joueurs_create');
        }

        return $this->render('admin/joueurs/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/joueurs/{id}/edit", name="admin_joueurs_edit")
     */
    public function edit(Joueur $joueur, Request $request, ObjectManager $manager){
        $form = $this->createForm(JoueurType::class, $joueur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($joueur);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le joueur <strong>{$joueur->getPrenom()}</strong> <strong>{$joueur->getNom()}</strong> a bien été enregistré"
            );
        }

        return $this->render('admin/joueurs/edit.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/joueurs/{id}/delete", name="admin_joueurs_delete")
     */
    public function delete(Joueur $joueur, ObjectManager $manager){
        $manager->remove($joueur);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le joueur <strong>{$joueur->getPrenom()}</strong> <strong>{$joueur->getNom()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_joueurs_index');
    }

}
