<?php

namespace App\Form;

use App\Entity\Campus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('campus', EntityType::class, [
                'label' => 'Campus : ',
                'class' => Campus::class,
                'choice_label' => function(Campus $campus) {
                    return sprintf('%s', $campus->getNom());
                },
                'required' => false
            ])
            ->add('search', SearchType::class, [
                'required' => false,
                'attr' => array(
                    'placeholder' => ' Recherche par nom')
            ])
            ->add('dateUn', DateType::class, [
                'label' => 'Entre ',
                'html5' => true,
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('dateDeux', DateType::class, [
                'label' => 'et ',
                'html5' => true,
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('sortieOrganisateur', CheckboxType::class, [
                'label' => 'Sortie dont je suis l\'organisateur(trice)',
                'required' => false
            ])
            ->add('sortieInscrit', CheckboxType::class, [
                'label' => 'Sortie auxquelles je suis inscrit(e)',
                'required' => false
            ])
            ->add('sortiePasInscrit', CheckboxType::class, [
                'label' => 'Sortie auxquelles je ne suis pas inscrit(e)',
                'required' => false
            ])
            ->add('sortiePassees', CheckboxType::class, [
                'label' => 'Sortie passées',
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ])

        ;



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
