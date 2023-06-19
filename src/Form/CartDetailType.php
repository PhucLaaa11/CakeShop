<?php

namespace App\Form;

use App\Entity\CartDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity' ,TextType::class,['label_attr'=>['class'=>'form-label'], 'attr'=>['class'=>'form-control']])
            ->add('discount', TextType::class,['label_attr'=>['class'=>'form-label'], 'attr'=>['class'=>'form-control']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-success']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CartDetail::class,
        ]);
    }
}
