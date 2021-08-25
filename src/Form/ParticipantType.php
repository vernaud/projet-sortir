<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo',TextType::class,[
                'label'=>'Pseudo ',
                'required'=> false,
            ])

            ->add('prenom',TextType::class,[
                'label'=>'Prénom ',
                'required'=> false,
            ])
            ->add('nom', TextType::class,[
                'label'=>'Nom ',
                'required'=> false,
            ])
            ->add('telephone', TextType::class,[
                'label'=>'Telephone',
                'required'=> false,
            ])
            ->add('email', EmailType::class,[
                'label'=>'Email ',
                'required'=> false,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'mot de passe',
                'required'=> true,
                'trim'=>true
            ])
//            ->add('plainPassword', RepeatedType::class, [
//                'type' => PasswordType::class,
//                'first_options' => [
//                    'attr' => ['autocomplete' => 'new-password'],
//                    'constraints' => [
//                         new NotBlank([
//                            'message' => 'Please enter a password',
//                        ]),
//                        new Length([
//                            'min' => 4,
//                            'minMessage' => 'Your password should be at least {{ limit }} characters',
//                            'max' => 4096,
//                        ]),
//                    ],
//                    'label' => 'New password',
//                ],
//                'second_options' => [
//                    'attr' => ['autocomplete' => 'new-password'],
//                    'label' => 'Repeat Password',
//                ],
//                'invalid_message' => 'The password fields must match.',
//                'mapped' => false,
//            ])

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
