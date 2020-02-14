<?php 

namespace App\Service;

use Twig\Environment;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RequestStack;

class PaginationService{
    private $entityClass;
    private $limit = 20; // Combien de données chercher
    private $currentPage = 1; // La page sur la quelle on est actuellement, par défaut c'est la 1
    private $templatePath; // Chemin du template qui affiche la pagination
    private $manager;
    private $twig;
    private $route;

    // Créé l'objectmanager pour pouvoir récupérer le repository de l'entité grâce à sa fonction getRepository
    // Créé la variable twig pour pouvoir s'adresser au moteur twig
    // Créé la variable request qui permet d'accéder à la requête au sein d'un service
    // Créé la variable templatePath qui a été définie directement dans le fichier services.yaml
    public function __construct(ObjectManager $manager, Environment $twig, RequestStack $request, $templatePath){
        $this->route = $request->getCurrentRequest()->attributes->get('_route');
        $this->manager = $manager;
        $this->twig = $twig;
        $this->templatePath = $templatePath;
    }

    public function setTemplatePath($templatePath){
        $this->templatePath = $templatePath;

        return $this;
    }

    public function getTemplatePath(){
        return $this->templatePath;
    }

    public function setRoute($route){
        $this->route = $route;

        return $this;
    }

    public function getRoute(){
        return $route;
    }

    // Permet d'afficher le contenu d'un fichier twig en lui donnant des variables
    public function display(){
        $this->twig->display($this->templatePath, [
            'page' => $this->currentPage,
            'pages' => $this->getPages(),
            'route' => $this->route
        ]);
    }

    // Fonction qui calcule le nombre de pages 
    public function getPages(){
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());

        // ceil = arrondi au nombre entier supérieur
        $pages = ceil($total / $this->limit);

        return $pages;
    }

    //Fonction qui récupère toutes les données à afficher sur la page
    public function getData(){
        // Offset = permet de dire à partir de quelle donnée on doit commencer à chercher
        $offset = $this->currentPage * $this->limit - $this->limit;

        $repo = $this->manager->getRepository($this->entityClass);
        $data = $repo->findBy([], [], $this->limit, $offset);

        return $data;
    }

    public function setPage($page){
        $this->currentPage = $page;

        return $this;
    }

    public function getPage(){
        return $this->currentPage;
    }

    public function setLimit($limit){
        $this->limit = $limit;

        return $this;
    }

    public function getLimit(){
        return $this->limit;
    }

    public function setEntityClass($entityClass){
        $this->entityClass = $entityClass;
        
        return $this;
    }

    public function getEntityClass(){
        return $this->entityClass;
    }
}