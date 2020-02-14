<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminEquipeController extends AbstractController
{
    /**
     * @Route("/admin/equipes/new", name="admin_equipes_create")
     */
    public function index(ObjectManager $manager, Request $request) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $equipe = new Equipe();

        $form = $this->createForm(EquipeType::class, $equipe);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            $manager->persist($equipe);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'équipe <strong>{$equipe->getNom()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_equipes_create');
        }

        return $this->render('admin/equipes/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/equipes/{id}/edit", name="admin_equipes_edit")
     */
    public function edit(Equipe $equipe, Request $request, ObjectManager $manager){
        $form = $this->createForm(EquipeType::class, $equipe);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($equipe);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'équipe <strong>{$equipe->getNom()}</strong> a bien été enregistrée"
            );
        }

        return $this->render('admin/equipes/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/equipes/{id}/delete", name="admin_equipes_delete")
     */
    public function delete(Equipe $equipe, ObjectManager $manager){
        $manager->remove($equipe);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'équipe <strong>{$equipe->getNom()}</strong> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_equipes_index');
    }
}
