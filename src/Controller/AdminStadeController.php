<?php

namespace App\Controller;

use App\Entity\Stade;
use App\Form\StadeType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminStadeController extends AbstractController
{
    /**
     * @Route("/admin/stades/new", name="admin_stades_create")
     */
    public function create(ObjectManager $manager, Request $request) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $stade = new Stade();

        $form = $this->createForm(StadeType::class, $stade);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            $manager->persist($stade);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le stade <strong>{$stade->getNom()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_stades_create');
        }

        return $this->render('admin/stades/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/stades/{id}/edit", name="admin_stades_edit")
     */
    public function edit(Stade $stade, Request $request, ObjectManager $manager){
        $form = $this->createForm(StadeType::class, $stade);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($stade);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le stade <strong>{$stade->getNom()}</strong> a bien été enregistré"
            );
        }

        return $this->render('admin/stades/edit.html.twig', [
            'stade' => $stade,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/stades/{id}/delete", name="admin_stades_delete")
     */
    public function delete(Stade $stade, ObjectManager $manager){
        $manager->remove($stade);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le stade <strong>{$stade->getNom()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_stades_index');
    }
}
