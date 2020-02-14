<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Rencontre;
use App\Entity\StatsEquipe;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StatsEquipeType extends AbstractType
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
            ->add('rencontres', EntityType::class, [
                'class' => Rencontre::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.slug', 'ASC');
                },
                'choice_label' => 'slug',
            ])
            ->add('equipes', EntityType::class, [
                'class' => Equipe::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.nom', 'ASC');
                },
                'choice_label' => 'nom',
            ])
            ->add('dispositif', TextType::class, $this->getConfiguration("Dispositif", "Tapez le dispositif de l'équipe"))
            ->add('buts', IntegerType::class, $this->getConfiguration("Buts", "Tapez le nombre de buts de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('possession', TextType::class, $this->getConfiguration("Possession", "Tapez le % de possession de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('tirsC', IntegerType::class, $this->getConfiguration("Tirs Cadrés", "Tapez le nombre de tirs cadrés de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('tirs', IntegerType::class, $this->getConfiguration("Tirs", "Tapez le nombre de tirs de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('corners', IntegerType::class, $this->getConfiguration("Corners", "Tapez le nombre de corners de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('coupsFrancs', IntegerType::class, $this->getConfiguration("Coups Francs", "Tapez le nombre de coups francs de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('cartonsJaunes', IntegerType::class, $this->getConfiguration("Cartons Jaunes", "Tapez le nombre de cartons jaunes de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('cartonsRouges', IntegerType::class, $this->getConfiguration("Cartons Rouges", "Tapez le nombre de cartons rouges de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('fautes', IntegerType::class, $this->getConfiguration("Fautes", "Tapez le nombre de fautes de l'équipe (Automatique à la création)", [
                'required' => false]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StatsEquipe::class,
        ]);
    }
}
