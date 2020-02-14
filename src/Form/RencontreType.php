<?php

namespace App\Form;

use App\Entity\Stade;
use App\Entity\Equipe;
use App\Entity\Rencontre;
use App\Entity\StatsEquipe;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RencontreType extends AbstractType
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
            ->add('statut', ChoiceType::class, [
                'choices'  => [
                    'En attente' => 'En attente',
                    'En cours' => 'En cours',
                    'Fin' => 'Fin',
                ],
            ])
            ->add('slug', TextType::class, $this->getConfiguration("Slug","Adresse web (automatique)", [
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
            ->add('equipesD', EntityType::class, [
                'class' => Equipe::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'label' => 'Equipe à domicile'
            ])
            ->add('equipesE', EntityType::class, [
                'class' => Equipe::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'label' => 'Equipe à l\'extérieur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rencontre::class,
        ]);
    }
}
