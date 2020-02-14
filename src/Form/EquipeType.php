<?php

namespace App\Form;

use App\Entity\Stade;
use App\Entity\Equipe;
use App\Entity\Entraineur;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EquipeType extends AbstractType
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
            ->add('nom', TextType::class, $this->getConfiguration("Nom", "Tapez le nom de l'équipe"))
            ->add('surnom', TextType::class, $this->getConfiguration("Surnom", "Tapez le surnom de l'équipe"))
            ->add('logo', TextType::class, $this->getConfiguration("Logo", "Tapez l'url du logo de l'équipe"))
            ->add('description', TextareaType::class, $this->getConfiguration("Description", "Tapez la description de l'équipe"))
            ->add('president', TextType::class, $this->getConfiguration("President", "Tapez le nom du président de l'équipe"))
            ->add('fondation', TextType::class, $this->getConfiguration("Fondation", "Tapez la date de la fondation de l'équipe"))
            ->add('site', UrlType::class, $this->getConfiguration("Site", "Tapez l'url du site de l'équipe"))
            ->add('slug', TextType::class, $this->getConfiguration("Slug", "Adresse web (automatique)", [
                                                'required' => false
                                            ]))
            ->add('stades', EntityType::class, [
                'class' => Stade::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.nom', 'ASC');
                },
                'choice_label' => 'nom',
            ])
            ->add('entraineurs', EntityType::class, [
                'class' => Entraineur::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom', 'ASC');
                },
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
