<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatsJoueurRepository")
 * @ORM\HasLifecycleCallbacks
 */
class StatsJoueur
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
     *      min = 1,
     *      max = 50,
     *      minMessage = "La valeur minimum doit être 1",
     *      maxMessage = "La valeur maximum doit être 50")
     */
    private $num;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 120,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 120")

     */
    private $min;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 50")

     */
    private $buts;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 50")
     */
    private $passD;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 50")
     */
    private $tirsC;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 50")
     */
    private $tirs;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 50")
     */
    private $passes;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 50")
     */
    private $tacles;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 50")
     */
    private $fautes;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 50")
     */
    private $cartonsJaunes;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 50,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 50")
     */
    private $cartonsRouges;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Joueur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $disponible;

    /**
     * @ORM\PrePersist
     * @return void
     */
    public function initializeDispo()
    {
        if(empty($this->disponible)){
            $this->disponible = "oui";
        }
    }

    /**
     * @ORM\PrePersist
     * @return void
     */

    public function initializeStats()
    {
        $this->min = 0;
        $this->buts = 0;
        $this->passD = 0;
        $this->tirsC = 0;
        $this->tirs = 0;
        $this->passes = 0;
        $this->tacles = 0;
        $this->fautes = 0;
        $this->cartonsJaunes = 0;
        $this->cartonsRouges = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getButs(): ?int
    {
        return $this->buts;
    }

    public function setButs(int $buts): self
    {
        $this->buts = $buts;

        return $this;
    }

    public function getPassD(): ?int
    {
        return $this->passD;
    }

    public function setPassD(int $passD): self
    {
        $this->passD = $passD;

        return $this;
    }

    public function getTirsC(): ?int
    {
        return $this->tirsC;
    }

    public function setTirsC(int $tirsC): self
    {
        $this->tirsC = $tirsC;

        return $this;
    }

    public function getTirs(): ?int
    {
        return $this->tirs;
    }

    public function setTirs(int $tirs): self
    {
        $this->tirs = $tirs;

        return $this;
    }

    public function getPasses(): ?int
    {
        return $this->passes;
    }

    public function setPasses(int $passes): self
    {
        $this->passes = $passes;

        return $this;
    }

    public function getTacles(): ?int
    {
        return $this->tacles;
    }

    public function setTacles(int $tacles): self
    {
        $this->tacles = $tacles;

        return $this;
    }

    public function getFautes(): ?int
    {
        return $this->fautes;
    }

    public function setFautes(int $fautes): self
    {
        $this->fautes = $fautes;

        return $this;
    }

    public function getCartonsJaunes(): ?int
    {
        return $this->cartonsJaunes;
    }

    public function setCartonsJaunes(int $cartonsJaunes): self
    {
        $this->cartonsJaunes = $cartonsJaunes;

        return $this;
    }

    public function getCartonsRouges(): ?int
    {
        return $this->cartonsRouges;
    }

    public function setCartonsRouges(int $cartonsRouges): self
    {
        $this->cartonsRouges = $cartonsRouges;

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

    public function getDisponible(): ?string
    {
        return $this->disponible;
    }

    public function setDisponible(string $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }
}
