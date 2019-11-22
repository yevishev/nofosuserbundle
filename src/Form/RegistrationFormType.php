<?php

namespace App\Form;

use App\Entity\User;
use App\Services\ReferrerService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    /**
     * @var ReferrerService
     */
    private $rs;

    public function __construct(ReferrerService $rs)
    {
        $this->rs = $rs;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('first_name', TextType::class, [
                'attr' => ['class' => 'form-control',
                    'placeholder' => 'First name'
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a first name',
                    ]),
                    new Regex([
                        'pattern' => '/[а-яёА-ЯЁa-zA-Z]{2,30}$/',
                        'message' => 'Invalid first name'
                    ])
                ]
            ])
            ->add('last_name', TextType::class, [
                'attr' => ['class' => 'form-control',
                    'placeholder' => 'Last name'
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a second name',
                    ]),
                    new Regex([
                        'pattern' => '/[а-яёА-ЯЁa-zA-Z]{2,30}/ui',
                        'message' => 'Invalid last name'
                    ])
                ]
            ])
            ->add('phone', TelType::class, [
                'attr' => ['class' => 'form-control',
                    'placeholder' => 'Phone number'
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a first name',
                    ]),
                    new Regex([
                        'pattern' => '/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){6,15}(\s*)?$/',
                        'message' => 'Invalid phone number'
                    ])
                ]
            ])
            ->add('referrer', ChoiceType::class, [
                'mapped' => false,
                'choices' => $this->rs->query(),
                'label' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('company', TextType::class, [
                'mapped' => false,
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Company'
                ]
            ])
            ->add('enterPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Пароли не совпадают',
                'options' => ['attr' => ['class' => 'form-control']],
                'required' => true,
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Enter password',
                        'class' => 'form-control'
                    ]
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Repeat password',
                        'class' => 'form-control'
                    ]
                ],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 18,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => 'Aссept terms '
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
