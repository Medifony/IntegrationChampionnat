<?php

namespace App\Controller;

use App\Entity\JoueRencontre;
use App\Form\JoueRencontreType;
use App\Repository\JoueRencontreRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminJoueRencontreController extends AbstractController
{
    /**
     * @Route("/admin/jouerenc/new", name="admin_jouerencontres_create")
     */
    public function index(ObjectManager $manager, Request $request, JoueRencontreRepository $repoJoueR) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $joueRencontre = new JoueRencontre();

        $form = $this->createForm(JoueRencontreType::class, $joueRencontre);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            if($joueRencontre->getJoueurs()->getEquipes()->getSlug() != $joueRencontre->getRencontres()->getEquipesD()->getSlug()
               &&
               $joueRencontre->getJoueurs()->getEquipes()->getSlug() != $joueRencontre->getRencontres()->getEquipesE()->getSlug())
            {
                $this->addFlash(
                    'danger',
                    "Le joueur <strong>{$joueRencontre->getJoueurs()->getNom()}</strong> ne fait pas partie des équipes de la rencontre 
                    <strong>{$joueRencontre->getRencontres()->getSlug()}</strong>."
                );
                
                return $this->render('admin/joueRencontres/new.html.twig', [
                    'joueRenc' => $joueRencontre,
                    'form' => $form->createView()
                ]);
            }
            if($joueRencontre->getJoueurs() != $joueRencontre->getStatsJoueurs()->getJoueurs())
            {
                $this->addFlash(
                    'danger',
                    "La statistique <strong>{$joueRencontre->getStatsJoueurs()->getId()}</strong> est liée au joueur <strong>{$joueRencontre->getStatsJoueurs()->getJoueurs()->getNom()}</strong>"
                );
                
                return $this->render('admin/joueRencontres/new.html.twig', [
                    'joueRenc' => $joueRencontre,
                    'form' => $form->createView()
                ]);
            }
            /*
            if($joueRencontre->getTitRem() == 'Titulaire'){
                $titulaires = $repoJoueR->findBy(
                    array('titRem' => 'Titulaire'),
                    array('joueurs.equipes.slug' => $joueRencontre->getJoueurs()->getEquipes()->getSlug())
                );

                if(count($titulaires) >= 1){
                    $this->addFlash(
                        'danger',
                        "Il ne peut pas y avoir plus de 11 titulaires dans une même équipe."
                    );
                    
                    return $this->render('admin/joueRencontres/new.html.twig', [
                        'joueRenc' => $joueRencontre,
                        'form' => $form->createView()
                    ]);
                }
            }*/
            $joueRencontre->getStatsjoueurs()->setDisponible('non');
            $manager->persist($joueRencontre);
            $manager->flush();

            $this->addFlash(
                'success',
                "La rencontre du joueur <strong>{$joueRencontre->getJoueurs()->getPrenom()}</strong> 
                <strong>{$joueRencontre->getJoueurs()->getNom()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('admin_jouerencontres_create');
        }

        return $this->render('admin/joueRencontres/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/jouerenc/{id}/edit", name="admin_jouerencontres_edit")
     */
    public function edit(JoueRencontre $joueRenc, Request $request, ObjectManager $manager, 
                        JoueRencontreRepository $repoJoueR){
        $form = $this->createForm(JoueRencontreType::class, $joueRenc);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if($joueRenc->getJoueurs()->getEquipes()->getSlug() != $joueRenc->getRencontres()->getEquipesD()->getSlug()
               &&
               $joueRenc->getJoueurs()->getEquipes()->getSlug() != $joueRenc->getRencontres()->getEquipesE()->getSlug())
            {
                $this->addFlash(
                    'danger',
                    "Le joueur <strong>{$joueRenc->getJoueurs()->getNom()}</strong> ne fait pas partie des équipes de la rencontre 
                    <strong>{$joueRenc->getRencontres()->getSlug()}</strong>."
                );
                
                return $this->render('admin/joueRencontres/new.html.twig', [
                    'joueRenc' => $joueRenc,
                    'form' => $form->createView()
                ]);
            }

            if($joueRenc->getJoueurs() != $joueRenc->getStatsJoueurs()->getJoueurs())
            {
                $this->addFlash(
                    'danger',
                    "La statistique <strong>{$joueRenc->getStatsJoueurs()->getId()}</strong> 
                    est liée au joueur <strong>{$joueRenc->getStatsJoueurs()->getJoueurs()->getNom()}</strong>"
                );
                
                return $this->render('admin/joueRencontres/new.html.twig', [
                    'joueRenc' => $joueRenc,
                    'form' => $form->createView()
                ]);
            }

            /*if($joueRenc->getTitRem() == 'Titulaire'){
                $titulaires = $repoJoueR->findBy(
                    array('titRem' => 'Titulaire'),
                    array('joueurs.equipes.slug' => $joueRenc->getEquipes()->getSlug())
                );

                if(count($titulaires) >= 1){
                    $this->addFlash(
                        'danger',
                        "Il ne peut pas y avoir plus de 11 titulaires dans une même équipe."
                    );
                    
                    return $this->render('admin/joueRencontres/new.html.twig', [
                        'joueRenc' => $joueRenc,
                        'form' => $form->createView()
                    ]);
                }
            }*/

            $manager->persist($joueRenc);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le jeu du joueur <strong>{$joueRenc->getJoueurs()->getPrenom()}</strong> 
                <strong>{$joueRenc->getJoueurs()->getNom()}</strong> a bien été enregistré"
            );
        }

        return $this->render('admin/joueRencontres/new.html.twig', [
            'joueRenc' => $joueRenc,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/jouerenc/{id}/delete", name="admin_jouerencontres_delete")
     */
    public function delete(JoueRencontre $joueRenc, ObjectManager $manager){
        $manager->remove($joueRenc);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le jeu du joueur <strong>{$joueRenc->getJoueurs()->getPrenom()}</strong> 
            <strong>{$joueRenc->getJoueurs()->getNom()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_jouerencontres_index');
    }
}
