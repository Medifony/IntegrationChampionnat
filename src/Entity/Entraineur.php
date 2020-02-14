<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntraineurRepository")
 */
class Entraineur
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
     * @Assert\Length(min=10, max=255, minMessage="Le lien vers la photo doit faire plus de 9 caractères !", 
     *                                maxMessage="Le lien vers la photo ne peut pas faire plus de 255 caractères !")
     */
    private $photo;

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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
