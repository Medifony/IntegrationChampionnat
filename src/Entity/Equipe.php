<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipeRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *  fields={"slug"},
 *  message="Une autre équipe possède déjà ce slug",
 * )
 * @UniqueEntity(
 *  fields={"stades"},
 *  message="Une autre équipe possède déjà ce stade",
 * )
 * 
 * @UniqueEntity(
 *  fields={"entraineurs"},
 *  message="Une autre équipe possède déjà cet entraineur",
 * )
 */
class Equipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="Le nom doit faire plus de 2 caractères !", 
     *                                maxMessage="Le nom ne peut pas faire plus de 255 caractères !")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="Le surnom doit faire plus de 2 caractères !", 
     *                                maxMessage="Le surnom ne peut pas faire plus de 255 caractères !")
     */
    private $surnom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=10, max=255, minMessage="Le lien vers le logo doit faire plus de 9 caractères !", 
     *                                maxMessage="Le lien vers le logo ne peut pas faire plus de 255 caractères !")
     */
    private $logo;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=15, minMessage="La description doit faire plus de 14 caractères !")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="Le président doit faire plus de 2 caractères !", 
     *                                maxMessage="Le président ne peut pas faire plus de 255 caractères !")
     */
    private $president;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=4, max=255, minMessage="La fondation doit faire plus de 3 caractères !", 
     *                                maxMessage="La fondation ne peut pas faire plus de 255 caractères !")
     */
    private $fondation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=10, max=255, minMessage="Le site doit faire plus de 9 caractères !", 
     *                                maxMessage="Le site ne peut pas faire plus de 255 caractères !")
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stade")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stades;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Entraineur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $entraineurs;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="Le slug doit faire plus de 2 caractères !", 
     *                                maxMessage="Le slug ne peut pas faire plus de 255 caractères !")
     */
    private $slug;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @return void
     */
    public function initializeSlug()
    {
        if(empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->nom);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSurnom(): ?string
    {
        return $this->surnom;
    }

    public function setSurnom(string $surnom): self
    {
        $this->surnom = $surnom;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPresident(): ?string
    {
        return $this->president;
    }

    public function setPresident(string $president): self
    {
        $this->president = $president;

        return $this;
    }

    public function getFondation(): ?string
    {
        return $this->fondation;
    }

    public function setFondation(string $fondation): self
    {
        $this->fondation = $fondation;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(string $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getStades(): ?Stade
    {
        return $this->stades;
    }

    public function setStades(?Stade $stades): self
    {
        $this->stades = $stades;

        return $this;
    }

    public function getEntraineurs(): ?Entraineur
    {
        return $this->entraineurs;
    }

    public function setEntraineurs(Entraineur $entraineurs): self
    {
        $this->entraineurs = $entraineurs;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
