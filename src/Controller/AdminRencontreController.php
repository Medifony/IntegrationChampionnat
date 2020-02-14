<?php

namespace App\Controller;

use App\Entity\Rencontre;
use App\Entity\Calendrier;
use App\Form\RencontreType;
use App\Form\CalendrierType;
use App\Repository\RencontreRepository;
use App\Repository\StatsEquipeRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminRencontreController extends AbstractController
{
    /**
     * @Route("/admin/rencontres/new", name="admin_rencontres_create")
     */
    public function create(ObjectManager $manager, Request $request, RencontreRepository $repoRenc) // Variable qui correspond à la requête HTTP avec notamment les données du POST
    {
        $rencontre = new Rencontre();

        $form = $this->createForm(RencontreType::class, $rencontre);

        $form->handleRequest($request); // Récupère la requête et l'enregistre dans form

        if($form->isSubmitted() && $form->isValid()){ // Est ce que le form a été soumis et validé par rapport aux règles en place
            
            if( $rencontre->getStatut() != "En attente")
            {
                $this->addFlash(
                    'danger',
                    "Lorsqu'une rencontre vient d'être crée, elle doit avoir le statut <strong>\"En attente\"</strong>"
                ); 
            }
            else
            {
                $manager->persist($rencontre);
                $rencSlug = $repoRenc->findBySlug($rencontre->getSlug());

                if(count($rencSlug) >= 1)
                {
                    $this->addFlash(
                        'danger',
                        "Une recontre possède déjà le slug <strong>{$rencontre->getSlug()}</strong> "
                    );
                    
                    return $this->redirectToRoute('admin_rencontres_create');
                }
                $manager->flush();

                $this->addFlash(
                    'success',
                    "La rencontre <strong>{$rencontre->getSlug()}</strong> a bien été enregistré !"
                );
            }
            return $this->redirectToRoute('admin_rencontres_create');
        }

        return $this->render('admin/rencontres/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/rencontres/{id}/edit", name="admin_rencontres_edit")
     */
    public function edit(Rencontre $rencontre, Request $request, ObjectManager $manager, StatsEquipeRepository $repoStEq){
        $form = $this->createForm(RencontreType::class, $rencontre);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if( $rencontre->getStatut() != "En attente")
            {
               $stEquipes = $repoStEq->findByRencontres($rencontre);
               
               if(count($stEquipes) == 2)
               {
                    if($stEquipes[0]->getEquipes()->getId() == $rencontre->getEquipesD()->getId()){
                        $statsD = $stEquipes[0];
                        $statsE = $stEquipes[1];
                    }
                    else
                    {
                        $statsD = $stEquipes[1];
                        $statsE = $stEquipes[0];
                    }
                    $rencontre->setStatsEqD($statsD);
                    $rencontre->setStatsEqE($statsE);
                }
                else
                {
                    $rencontre->setStatut("En attente");
                    $this->addFlash(
                        'danger',
                        "La rencontre <strong>{$rencontre->getSlug()}</strong> ne peut pas sortir du statut <strong>\"En attente\"</strong> 
                        car elle ne possède pas une statistique pour chacune des deux équipes qui s'affrontent"
                    );
                    
                    return $this->render('admin/rencontres/edit.html.twig', [
                        'renc' => $rencontre,
                        'form' => $form->createView()
                    ]);
                }
            }

            $manager->persist($rencontre);
            $manager->flush();

            $this->addFlash(
                'success',
                "La rencontre <strong>{$rencontre->getSlug()}</strong> a bien été enregistrée"
            );
        }

        return $this->render('admin/rencontres/edit.html.twig', [
            'renc' => $rencontre,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/rencontres/{id}/delete", name="admin_rencontres_delete")
     */
    public function delete(Rencontre $rencontre, ObjectManager $manager){
        $manager->remove($rencontre);
        $manager->flush();

        $this->addFlash(
            'success',
            "La rencontre <strong>{$rencontre->getSlug()}</strong> a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_rencontres_index');
    }
}
