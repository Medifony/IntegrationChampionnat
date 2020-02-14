<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JoueurRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *  fields={"slug"},
 *  message="Un autre joueur possède déjà ce slug",
 * )
 */
class Joueur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="Le prénom doit faire plus de 2 caractères !", 
     *                                maxMessage="Le prénom ne peut pas faire plus de 255 caractères !")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="Le nom doit faire plus de 2 caractères !", 
     *                                maxMessage="Le nom ne peut pas faire plus de 255 caractères !")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=10, max=255, minMessage="Le lien vers la photo doit faire plus de 9 caractères !", 
     *                                maxMessage="Le lien vers la photo ne peut pas faire plus de 255 caractères !")
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=10, max=255, minMessage="L'age doit faire plus de 9 caractères !", 
     *                                maxMessage="L'age ne peut pas faire plus de 255 caractères !")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="Le poste doit faire plus de 2 caractères !", 
     *                                maxMessage="Le poste ne peut pas faire plus de 255 caractères !")
     */
    private $poste;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2, max=255, minMessage="La taille doit faire plus de 1 caractère !", 
     *                                maxMessage="La taille ne peut pas faire plus de 255 caractères !")
     */
    private $taille;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 50,
     *      max = 150,
     *      minMessage = "La valeur minimum doit être 50",
     *      maxMessage = "La valeur maximum doit être 150")
     */
    private $poids;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=255, minMessage="La nationalité doit faire plus de 2 caractère !", 
     *                                maxMessage="La nationalité ne peut pas faire plus de 255 caractères !")
     */
    private $nationalite;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10, minMessage="La description doit faire plus de 9 caractère !")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipes;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, minMessage="La description doit faire plus de 4 caractère !")
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
            $nomprenom = $this->prenom . ' ' . $this->nom;
            $this->slug = $slugify->slugify($nomprenom);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

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

    public function getEquipes(): ?Equipe
    {
        return $this->equipes;
    }

    public function setEquipes(?Equipe $equipes): self
    {
        $this->equipes = $equipes;

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
