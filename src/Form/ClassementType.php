<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Classement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ClassementType extends AbstractType
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
                'choice_label' => 'nom',
            ])
            ->add('victoires', IntegerType::class, $this->getConfiguration("Victoires", "Tapez le nombre de victoires de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('nuls', IntegerType::class, $this->getConfiguration("Nuls", "Tapez le nombre de matchs nuls de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('defaites', IntegerType::class, $this->getConfiguration("Défaites", "Tapez le nombre de défaites de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('dif', IntegerType::class, $this->getConfiguration("Différence de buts", "Tapez la différence de buts de l'équipe (Automatique à la création)", [
                'required' => false]))
            ->add('totbuts', IntegerType::class, $this->getConfiguration("Buts", "Tapez le total de buts de l'équipe (Automatique à la création)", [
                'required' => false]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Classement::class,
        ]);
    }
}
