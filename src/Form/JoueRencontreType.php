<?php

namespace App\Form;

use App\Entity\Joueur;
use App\Entity\Rencontre;
use App\Entity\StatsJoueur;
use App\Entity\JoueRencontre;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use App\Repository\StatsJoueurRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class JoueRencontreType extends AbstractType
{
    private function getConfiguration($label, $placeholder){
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titRem', ChoiceType::class, [
                'choices'  => [
                    'Titulaire' => 'Titulaire',
                    'Remplaçant' => 'Remplaçant',
                ],
                'label' => 'Statut'
            ])
            ->add('rencontres', EntityType::class, [
                'class' => Rencontre::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('jou')
                        ->orderBy('jou.slug', 'ASC');
                },
                'choice_label' => 'slug',
            ])
            ->add('joueurs', EntityType::class, [
                'class' => Joueur::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('jou')
                        ->orderBy('jou.nom', 'ASC');
                },
                'choice_label' => 'nom',
            ])
            ->add('statsjoueurs', EntityType::class, [
                'class' => StatsJoueur::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('stJ')
                        ->where('stJ.disponible = \'oui\'')
                        ->orderBy('stJ.id', 'ASC');
                },
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JoueRencontre::class,
        ]);
    }
}
