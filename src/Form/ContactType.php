<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('names', TextType::class, [
                'label' => 'Вашите имена <span class="text-danger"> * </span>',
                'attr' => [
                    'placeholder' => 'Вашите имена',
                    'class' => 'form-control'
                ],
                'label_html' => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'Имейл адрес за връзка <span class="text-danger"> * </span>',
                'attr' => [
                    'placeholder' => 'Имейл адрес за връзка ',
                    'class' => 'form-control'
                ],
                'label_html' => true
            ])
            ->add('title', TextType::class, [
                'label' => 'Заглавие <span class="text-danger"> * </span>',
                'attr' => [
                    'placeholder' => 'Заглавие ',
                    'class' => 'form-control'
                ],
                'label_html' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Текст <span class="text-danger"> * </span>',
                'attr' => [
                    'placeholder' => 'Текст ',
                    'class' => 'form-control',
                    'rows' => 6,
                ],
                'label_html' => true
            ])
            ->add('thumbnailFile', VichImageType::class, [
                'label' => 'Прикачи изображение',
                'required' => false,
                'attr' => [
                    'class' => 'btn btn-light'
                ]])
//            ->add('contactType', EntityType::class, [
//                'class' => \App\Entity\ContactType::class,
////                'disabled' => true,
//                'label' => "Вид на съобщението",
//                'attr' => [
//                    'placeholder' => 'Вид на съобщението',
//                    'class' => 'form-control'
//                ]
//            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Изпрати',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
