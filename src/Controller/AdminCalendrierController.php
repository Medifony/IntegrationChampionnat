<?php

namespace App\Controller;

use App\Entity\Calendrier;
use App\Form\CalendrierType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCalendrierController extends AbstractController
{
    /**
     * @Route("/admin/calendriers/new", name="admin_calendriers_create")
     */
    public function create(ObjectManager $manager, Request $request) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $calendrier = new Calendrier();

        $form = $this->createForm(CalendrierType::class, $calendrier);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            $manager->persist($calendrier);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le calendrier de la rencontre <strong>{$calendrier->getRencontres()->getSlug()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_calendriers_create');
        }

        return $this->render('admin/calendriers/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/calendriers/{id}/edit", name="admin_calendriers_edit")
     */
    public function edit(Calendrier $calendrier, Request $request, ObjectManager $manager){
        $form = $this->createForm(CalendrierType::class, $calendrier);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($calendrier);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le calendrier de la rencontre <strong>{$calendrier->getRencontres()->getSlug()}</strong> a bien été enregistré"
            );
        }

        return $this->render('admin/calendriers/edit.html.twig', [
            'cal' => $calendrier,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/calendriers/{id}/delete", name="admin_calendriers_delete")
     */
    public function delete(Calendrier $calendrier, ObjectManager $manager){
        $manager->remove($calendrier);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le calendrier de la rencontre <strong>{$calendrier->getRencontres()->getSlug()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_calendriers_index');
    }
}
