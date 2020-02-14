<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RencontreRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *  fields={"slug"},
 *  message="Une autre rencontre possède déjà ce slug",
 * )
 */
class Rencontre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stade")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stades;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotEqualTo(propertyPath="equipesE", message="Les équipes à domicile et à l'extérieur doivent être différentes !")
     */
    private $equipesD;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotEqualTo(propertyPath="equipesD", message="Les équipes à domicile et à l'extérieur doivent être différentes !")
     */
    private $equipesE;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StatsEquipe", cascade={"persist", "remove"})
     */
    private $statsEqD;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StatsEquipe", cascade={"persist", "remove"})
     */
    private $statsEqE;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=6, max=255, minMessage="Le slug doit faire plus de 5 caractères !", 
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
            $this->slug = $slugify->slugify($this->equipesD->getNom() . " vs " . $this->equipesE->getNom());
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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

    public function getEquipesD(): ?Equipe
    {
        return $this->equipesD;
    }

    public function setEquipesD(?Equipe $equipesD): self
    {
        $this->equipesD = $equipesD;

        return $this;
    }

    public function getEquipesE(): ?Equipe
    {
        return $this->equipesE;
    }

    public function setEquipesE(?Equipe $equipesE): self
    {
        $this->equipesE = $equipesE;

        return $this;
    }

    public function getStatsEqD(): ?StatsEquipe
    {
        return $this->statsEqD;
    }

    public function setStatsEqD(?StatsEquipe $statsEqD): self
    {
        $this->statsEqD = $statsEqD;

        return $this;
    }

    public function getStatsEqE(): ?StatsEquipe
    {
        return $this->statsEqE;
    }

    public function setStatsEqE(?StatsEquipe $statsEqE): self
    {
        $this->statsEqE = $statsEqE;

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

