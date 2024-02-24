<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EmailValidator;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', options: [
                'label' => 'Email *',
                'constraints' => [
                    new Email([
                        'message' => "{{ value }} n'est pas valide"
                    ]),
                ],
            ])
            ->add('name', options: [
                'label' => 'Nom *',
                'constraints' => [
                    new NotBlank([
                        'message' => "Vous devez renseigner un nom"
                    ]),
                ],
            ])
            ->add('firstname', options: [
                'label' => 'Prénom *',
                'constraints' => [
                    new NotBlank([
                        'message' => "Vous devez renseigner un prénom"
                    ]),
                ],
            ])
            ->add('phone', options: [
                'label' => 'Téléphone',
            ])
            ->add('street', options: [
                'label' => 'Rue',
            ])
            ->add('zip_code', options: [
                'label' => 'Code postal',
            ])
            ->add('city', options: [
                'label' => 'Ville',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Vous devez entrer un mot de passe',
                        ]),
                        new Length([
                            'min' => 12,
                            'minMessage' => 'Le mot de passe doit comporter au minimum {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ],
                'first_options'  => ['label' => 'Mot de passe *'],
                'second_options' => ['label' => 'Confirmation *'],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Accepter les conditions *',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}