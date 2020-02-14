<?php

namespace App\Controller;

use App\Repository\ClassementRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClassController extends AbstractController
{
    /**
     * @Route("/classement", name="classpage")
     */
    public function index(ClassementRepository $repoClass)
    {
        $class = $repoClass->findBy([], array('points' => 'desc'));

        return $this->render('class/index.html.twig', [
            'class' => $class
        ]);
    }
}
