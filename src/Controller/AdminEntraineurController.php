<?php

namespace App\Controller;

use App\Entity\Entraineur;
use App\Form\EntraineurType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminEntraineurController extends AbstractController
{
    /**
     * @Route("/admin/entraineurs/new", name="admin_entraineurs_create")
     */
    public function index(ObjectManager $manager, Request $request) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $entraineur = new Entraineur();

        $form = $this->createForm(EntraineurType::class, $entraineur);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            $manager->persist($entraineur);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'entraineur <strong>{$entraineur->getNom()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_entraineurs_create');
        }

        return $this->render('admin/entraineurs/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/entraineurs/{id}/edit", name="admin_entraineurs_edit")
     */
    public function edit(Entraineur $entraineur, Request $request, ObjectManager $manager){
        $form = $this->createForm(EntraineurType::class, $entraineur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($entraineur);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'entraineur <strong>{$entraineur->getNom()}</strong> a bien été enregistré"
            );
        }

        return $this->render('admin/entraineurs/edit.html.twig', [
            'entraineur' => $entraineur,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/entraineurs/{id}/delete", name="admin_entraineurs_delete")
     */
    public function delete(Entraineur $entraineur, ObjectManager $manager){
        $manager->remove($entraineur);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'entraineur <strong>{$entraineur->getNom()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_entraineurs_index');
    }
}
