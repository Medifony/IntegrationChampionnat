<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassementRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *  fields={"equipes"},
 *  message="Cette équipe a déjà un classement.",
 * )
 */
class Classement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $victoires;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $nuls;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $defaites;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $dif;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $points;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Equipe", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $joues;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $totbuts;

    /**
     * @ORM\PrePersist
     * @return void
     */

    public function initializeStats()
    {
        $this->victoires = 0;
        $this->nuls = 0;
        $this->defaites = 0;
        $this->dif = 0;
        $this->totbuts = 0;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @return void
     */
    public function majStats()
    {
        $this->joues = $this->victoires + $this->nuls + $this->defaites;
        $this->points = ($this->victoires * 3) + $this->nuls;
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVictoires(): ?int
    {
        return $this->victoires;
    }

    public function setVictoires(int $victoires): self
    {
        $this->victoires = $victoires;

        return $this;
    }

    public function getNuls(): ?int
    {
        return $this->nuls;
    }

    public function setNuls(int $nuls): self
    {
        $this->nuls = $nuls;

        return $this;
    }

    public function getDefaites(): ?int
    {
        return $this->defaites;
    }

    public function setDefaites(int $defaites): self
    {
        $this->defaites = $defaites;

        return $this;
    }

    public function getDif(): ?int
    {
        return $this->dif;
    }

    public function setDif(int $dif): self
    {
        $this->dif = $dif;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getEquipes(): ?Equipe
    {
        return $this->equipes;
    }

    public function setEquipes(Equipe $equipes): self
    {
        $this->equipes = $equipes;

        return $this;
    }

    public function getJoues(): ?int
    {
        return $this->joues;
    }

    public function setJoues(?int $joues): self
    {
        $this->joues = $joues;

        return $this;
    }

    public function getTotbuts(): ?int
    {
        return $this->totbuts;
    }

    public function setTotbuts(?int $totbuts): self
    {
        $this->totbuts = $totbuts;

        return $this;
    }
}
