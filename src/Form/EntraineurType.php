<?php

namespace App\Form;

use App\Entity\Entraineur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EntraineurType extends AbstractType
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
            ->add('nom', TextType::class, $this->getConfiguration("Nom", "Tapez le nom et le prénom de l'entraineur"))
            ->add('photo', TextType::class, $this->getConfiguration("Photo", "Tapez l'url de la photo de l'entraineur'"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entraineur::class,
        ]);
    }
}
