<?php

namespace App\Form;

use App\Entity\Lieu;
use App\Entity\Sortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nom', TextType::class, [
                'label'=>"Nom"
            ])
            ->add('dateHeureDebut', DateTimeType::class, [
                'label'=>'Date et heure de la sortie'
            ])
            ->add('duree', IntegerType::class, [
                'label'=>'Durée (en minutes)'
            ])
            ->add('dateLimiteInscription', DateType::class, [
                'html5' => true,
                'widget' => 'single_text',
                'label'=>'Date limite d\'inscription'
            ])
            ->add('nbInscriptionsMax', IntegerType::class, [
                'label'=>'Nombre de places'
            ])
            ->add('infosSortie', TextareaType::class, [
                'label'=>'Description'
            ])

            ->add('lieu',EntityType::class, [
                'class'=>Lieu::class,
                'choice_label'=>'nom',
                'label'=>'Lieu'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}