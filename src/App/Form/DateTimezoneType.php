<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Timezone;
class DateTimezoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'The date is required.',
                    ]),
                    new Regex([
                        'pattern' => '/^\d{4}-\d{2}-\d{2}$/',
                        'message' => 'The date must be in the format YYYY-MM-DD.',
                    ])
                ],
                'label' => 'Date (Y-m-d)',
            ])
            ->add('timezone', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'The timezone is required.',
                    ]),
                    new Timezone([
                        'message' => 'The provided timezone is not valid.'
                    ])
                ],
                'label' => 'Timezone (e.g., Europe/London)',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit'
            ]);
    }
}