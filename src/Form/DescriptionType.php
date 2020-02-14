<?php

namespace App\Form;

use App\Entity\Description;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class DescriptionType extends AbstractType
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
            ->add('nom', TextType::class, $this->getConfiguration("Nom", "Tapez le nom du championnat"))
            ->add('logo', TextType::class, $this->getConfiguration("Logo", "URL du logo du championnat"))
            ->add('nav', TextType::class, $this->getConfiguration("NavBar", "Tapez le déminutif pour la NavBar"))
            ->add('journee', IntegerType::class, $this->getConfiguration("Journée", "Tapez la journée en cours du championnat"))
            ->add('saison', TextType::class, $this->getConfiguration("Saison", "Tapez la saison du championnat"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Description::class,
        ]);
    }
}
