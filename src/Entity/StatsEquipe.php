<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatsEquipeRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *  fields={"rencontres", "equipes"},
 *  message="Une statistique a déjà été enregistrée pour cette équipe dans cette rencontre.",
 * )
 */
class StatsEquipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=10, minMessage="Le dispositif doit faire plus de 2 caractères !", 
     *                                maxMessage="Le dispositif ne peut pas faire plus de 10 caractères !")
     */
    private $dispositif;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $buts;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $possession;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $tirsC;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $tirs;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $corners;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $coupsFrancs;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $cartonsJaunes;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $cartonsRouges;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $fautes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rencontre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rencontres;

    /**
     * @ORM\PrePersist
     * @return void
     */

    public function initializeStats()
    {
        $this->buts = 0;
        $this->possession = 0;
        $this->tirsC = 0;
        $this->tirs = 0;
        $this->corners = 0;
        $this->coupsFrancs = 0;
        $this->cartonsJaunes = 0;
        $this->cartonsRouges = 0;
        $this->fautes = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDispositif(): ?string
    {
        return $this->dispositif;
    }

    public function setDispositif(string $dispositif): self
    {
        $this->dispositif = $dispositif;

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

    public function getPossession(): ?string
    {
        return $this->possession;
    }

    public function setPossession(string $possession): self
    {
        $this->possession = $possession;

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

    public function getCorners(): ?int
    {
        return $this->corners;
    }

    public function setCorners(int $corners): self
    {
        $this->corners = $corners;

        return $this;
    }

    public function getCoupsFrancs(): ?int
    {
        return $this->coupsFrancs;
    }

    public function setCoupsFrancs(int $coupsFrancs): self
    {
        $this->coupsFrancs = $coupsFrancs;

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

    public function getFautes(): ?int
    {
        return $this->fautes;
    }

    public function setFautes(int $fautes): self
    {
        $this->fautes = $fautes;

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

    public function getRencontres(): ?Rencontre
    {
        return $this->rencontres;
    }

    public function setRencontres(?Rencontre $rencontres): self
    {
        $this->rencontres = $rencontres;

        return $this;
    }
}
