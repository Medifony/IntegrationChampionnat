<?php

namespace App\Form;

use App\Entity\Joueur;
use App\Entity\StatsJoueur;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StatsJoueurType extends AbstractType
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
            ->add('joueurs', EntityType::class, [
                'class' => Joueur::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('j')
                        ->orderBy('j.nom', 'ASC');
                },
                'choice_label' => 'nom',
            ])
            ->add('num', IntegerType::class, $this->getConfiguration("Numéro", "Tapez le numéro du joueur"))
            ->add('min', IntegerType::class, $this->getConfiguration("Minutes", "Tapez les minutes de jeu du joueur (Automatique à la création)", [
                'required' => false]))
            ->add('buts', IntegerType::class, $this->getConfiguration("Buts", "Tapez le nombre de buts du joueur (Automatique à la création)", [
                'required' => false]))
            ->add('passD', IntegerType::class, $this->getConfiguration("Passes Décisives", "Tapez le nombre de passes décisives du joueur (Automatique à la création)", [
                'required' => false]))
            ->add('tirsC', IntegerType::class, $this->getConfiguration("Tirs Cadrés", "Tapez le nombre de tirs cadrés du joueur (Automatique à la création)", [
                'required' => false]))
            ->add('tirs', IntegerType::class, $this->getConfiguration("Tirs", "Tapez le nombre de tirs du joueur (Automatique à la création)", [
                'required' => false]))
            ->add('passes', IntegerType::class, $this->getConfiguration("Passes", "Tapez le nombre de passes du joueur (Automatique à la création)", [
                'required' => false]))
            ->add('tacles', IntegerType::class, $this->getConfiguration("Tacles", "Tapez le nombre de tacles du joueur (Automatique à la création)", [
                'required' => false]))
            ->add('fautes', IntegerType::class, $this->getConfiguration("Fautes", "Tapez le nombre de fautes joueur (Automatique à la création)", [
                'required' => false]))
            ->add('cartonsJaunes', IntegerType::class, $this->getConfiguration("Cartons Jaunes", "Tapez le nombre de cartons jaunes du joueur (Automatique à la création)", [
                'required' => false]))
            ->add('cartonsRouges', IntegerType::class, $this->getConfiguration("Cartons Rouges", "Tapez le nombre de cartons rouges du joueur (Automatique à la création)", [
                'required' => false]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StatsJoueur::class,
        ]);
    }
}
