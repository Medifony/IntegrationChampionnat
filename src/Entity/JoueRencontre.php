<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JoueRencontreRepository")
 * @UniqueEntity(
 *  fields={"joueurs", "rencontres"},
 *  message="Ce joueur joue déjà cette rencontre.",
 * )
 */
class JoueRencontre
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
    private $titRem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rencontre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rencontres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueurs;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StatsJoueur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $statsjoueurs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitRem(): ?string
    {
        return $this->titRem;
    }

    public function setTitRem(string $titRem): self
    {
        $this->titRem = $titRem;

        return $this;
    }

    public function getRencontres(): ?Rencontre
    {
        return $this->rencontres;
    }

    public function setRencontres(?Rencontre $rencontres): self
    {
        $this->rencontres = $rencontres;

        return $this;
    }

    public function getJoueurs(): ?Joueur
    {
        return $this->joueurs;
    }

    public function setJoueurs(?Joueur $joueurs): self
    {
        $this->joueurs = $joueurs;

        return $this;
    }

    public function getStatsjoueurs(): ?StatsJoueur
    {
        return $this->statsjoueurs;
    }

    public function setStatsjoueurs(StatsJoueur $statsjoueurs): self
    {
        $this->statsjoueurs = $statsjoueurs;

        return $this;
    }
}
