<?php

namespace App\Controller;

use App\Entity\Description;
use App\Form\DescriptionType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDescriptionController extends AbstractController
{
    /**
     * @Route("/admin/new", name="admin_description_create")
     */
    public function create(ObjectManager $manager, Request $request) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $description = new Description();

        $form = $this->createForm(DescriptionType::class, $description);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            $manager->persist($description);
            $manager->flush();

            $this->addFlash(
                'success',
                "La description du championnat <strong>{$description->getNom()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_description_create');
        }

        return $this->render('admin/description/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}/edit", name="admin_description_edit")
     */
    public function edit(Description $description, Request $request, ObjectManager $manager){
        $form = $this->createForm(DescriptionType::class, $description);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($description);
            $manager->flush();

            $this->addFlash(
                'success',
                "La description du championnat <strong>{$description->getNom()}</strong> a bien été enregistré !"
            );
        }

        return $this->render('admin/description/edit.html.twig', [
            'descr' => $description,
            'form' => $form->createView()
        ]);
    }

}
