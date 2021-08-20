<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo',TextType::class,[
                'label'=>'Pseudo '
            ])

            ->add('prenom',TextType::class,[
                'label'=>'Prénom '
            ])
            ->add('nom', TextType::class,[
                'label'=>'Nom '
            ])
            ->add('telephone', NumberType::class,[
                'label'=>'Telephone '
            ])
            ->add('email', EmailType::class,[
                'label'=>'Email '
            ])
            ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots pass ne correspondent pas.',
            'required' => true,
            'first_options' => ['label' => 'Mot de passe '],
            'second_options'=> ['label' => 'Mot de passe '],
            ])

//          ->add('campus')

//           ->add('Ma photo')

        ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ])
        ;
    }
}
