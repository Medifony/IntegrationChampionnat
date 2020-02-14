<?php

namespace App\Controller;

use App\Entity\Classement;
use App\Form\ClassementType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminClassementController extends AbstractController
{
    /**
     * @Route("/admin/classements/new", name="admin_classements_create")
     */
    public function index(ObjectManager $manager, Request $request) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $classement = new Classement();

        $form = $this->createForm(ClassementType::class, $classement);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            $manager->persist($classement);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le classement de l'équipe <strong>{$classement->getEquipes()->getNom()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_classements_create');
        }

        return $this->render('admin/classements/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/classements/{id}/edit", name="admin_classements_edit")
     */
    public function edit(Classement $classement, Request $request, ObjectManager $manager){
        $form = $this->createForm(ClassementType::class, $classement);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($classement);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le classement de l'équipe <strong>{$classement->getEquipes()->getNom()}</strong> a bien été enregistré"
            );
        }

        return $this->render('admin/classements/edit.html.twig', [
            'class' => $classement,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/classements/{id}/delete", name="admin_classements_delete")
     */
    public function delete(Classement $classement, ObjectManager $manager){
        $manager->remove($classement);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le classement de l'équipe <strong>{$classement->getEquipes()->getNom()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_classements_index');
    }
}
