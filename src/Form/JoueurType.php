<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Joueur;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class JoueurType extends AbstractType
{
    private function getConfiguration($label, $placeholder, $options = []){
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('equipes', EntityType::class, [
                'class' => Equipe::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('j')
                        ->orderBy('j.nom', 'ASC');
                },
                'choice_label' => 'nom',
            ])
            ->add('prenom', TextType::class, $this->getConfiguration("Prénom", "Tapez le prénom du joueur"))
            ->add('nom', TextType::class, $this->getConfiguration("Nom", "Tapez le nom du joueur"))
            ->add('photo', TextType::class, $this->getConfiguration("Photo", "Tapez l'url de la photo du joueur"))
            ->add('age', TextType::class, $this->getConfiguration("Age", "Tapez la date de naissance ainsi que l'âge du joueur"))
            ->add('poste', TextType::class, $this->getConfiguration("Poste", "Tapez le poste du joueur"))
            ->add('taille', TextType::class, $this->getConfiguration("Taille", "Tapez la taille du joueur (préciser mètre ou cm)"))
            ->add('poids', IntegerType::class, $this->getConfiguration("Poids", "Tapez le poids du joueur"))
            ->add('nationalite', TextType::class, $this->getConfiguration("Nationalité", "Tapez la nationalité du joueur"))
            ->add('description', TextareaType::class, $this->getConfiguration("Description", "Tapez la description du joueur"))
            ->add('slug', TextType::class, $this->getConfiguration("Slug", "Adresse web (automatique)", [
                                                                    'required' => false
                                                                ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Joueur::class,
        ]);
    }
}
