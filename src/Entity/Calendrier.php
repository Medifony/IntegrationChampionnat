<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CalendrierRepository")
 * @UniqueEntity(
 *  fields={"rencontres"},
 *  message="Un autre calendrier concerne déjà cette rencontre",
 * )
 */
class Calendrier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $calDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Rencontre", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $rencontres;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La valeur minimum doit être 0",
     *      maxMessage = "La valeur maximum doit être 100")
     */
    private $journee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalDate(): ?\DateTimeInterface
    {
        return $this->calDate;
    }

    public function setCalDate(?\DateTimeInterface $calDate): self
    {
        $this->calDate = $calDate;

        return $this;
    }

    public function getRencontres(): ?Rencontre
    {
        return $this->rencontres;
    }

    public function setRencontres(Rencontre $rencontres): self
    {
        $this->rencontres = $rencontres;

        return $this;
    }

    public function findHour(DateTime $date){
        return $date->format('H:i');
    }

    public function findDay(DateTime $date){
        return $date->format('d/m/Y');
    }

    public function getJournee(): ?int
    {
        return $this->journee;
    }

    public function setJournee(int $journee): self
    {
        $this->journee = $journee;

        return $this;
    }
}
