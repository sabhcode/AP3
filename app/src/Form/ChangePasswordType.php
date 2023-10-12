<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your current password',
                    ]),
                ],
                'label' => 'Current Password',
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options'  => ['label' => 'New password'],
                'second_options' => ['label' => 'Confirm new password'],
    
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
            ])
            
        ;
    }
}