<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StadeRepository")
 */
class Stade
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
     * @Assert\Length(min=3, max=255, minMessage="La ville doit faire plus de 2 caractères !", 
     *                                maxMessage="La ville ne peut pas faire plus de 255 caractères !")
     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="integer", message="La capacité doit être un nombre")
     * @Assert\Range(
     *      min = 10000,
     *      max = 150000,
     *      minMessage = "La valeur minimum doit être 1000",
     *      maxMessage = "La valeur maximum doit être 150 000")
     */
    private $capacite;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }
}
