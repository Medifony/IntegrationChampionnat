<?php

namespace App\Form;

use App\Entity\Rencontre;
use App\Entity\Calendrier;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CalendrierType extends AbstractType
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
            ->add('calDate', DateTimeType::class,[ 'date_format' => 'dd-MM-yyyy',
                                                    'label' => 'Date et Heure' ])
                                        
            ->add('journee', IntegerType::class, $this->getConfiguration("Journée", "Tapez la journée de la rencontre"))
            ->add('rencontres', EntityType::class, [
                'class' => Rencontre::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.slug', 'ASC');
                },
                'choice_label' => 'slug',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendrier::class,
        ]);
    }
}
