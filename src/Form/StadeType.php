<?php

namespace App\Form;

use App\Entity\Stade;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StadeType extends AbstractType
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
            ->add('nom', TextType::class, $this->getConfiguration("Nom", "Tapez le nom du stade"))
            ->add('ville', TextType::class, $this->getConfiguration("Ville", "Tapez le nom de la ville du stade"))
            ->add('capacite', IntegerType::class, $this->getConfiguration("Capacité", "Tapez la capacité du stade"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stade::class,
        ]);
    }
}
