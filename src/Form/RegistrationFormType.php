<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, ['label' => ' ', 'attr' => array('placeholder' => 'Prénom'), 'constraints' => [
                new NotBlank([
                    'message' => 'Merci de saisir votre prénom.',
                ])]])
            ->add('lastname', null, ['label' => ' ', 'attr' => array('placeholder' => 'Nom'), 'constraints' => [
                new NotBlank([
                    'message' => 'Merci de saisir votre nom.',
                ])]])
            ->add('email', null, ['label' => ' ', 'attr' => array('placeholder' => 'Email'), 'constraints' => [
                new NotBlank([
                    'message' => 'Merci de saisir votre email',
                ])]])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques.',
                'options' => ['attr' => ['class' => 'password-field', 'placeholder' => 'Mot de passe']],  'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de saisir votre mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
                'required' => true,
                'first_options' => ['label' => ' '],
                'second_options' => ['label' => ' ', 'attr' => ['placeholder' => 'Resaisir le mot de passe']],
            ])
//            ->add('plainPassword', PasswordType::class, ['label' => '  ', 'attr' => array('placeholder' => 'Password '),
//                // instead of being set onto the object directly,
//                // this is read and encoded in the controller
//                'mapped' => false,
//                'constraints' => [
//                    new NotBlank([
//                        'message' => 'Merci de saisir votre mot de passe',
//                    ]),
//                    new Length([
//                        'min' => 8,
//                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
//                        // max length allowed by Symfony for security reasons
//                        'max' => 255,
//                    ]),
//                ],
//            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions d\'utilisation du site.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
