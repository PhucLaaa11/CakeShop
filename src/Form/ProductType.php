<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Supplier;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,['label_attr'=>['class'=>'form-label'], 'attr'=>['class'=>'form-control']])
            ->add('maintaste', TextType::class,['label_attr'=>['class'=>'form-label'], 'attr'=>['class'=>'form-control']])
            ->add('price', TextType::class,['label_attr'=>['class'=>'form-label'], 'attr'=>['class'=>'form-control']])
            ->add('count', TextType::class,['label_attr'=>['class'=>'form-label'], 'attr'=>['class'=>'form-control']])
            ->add('supplier', EntityType::class, [
                "class" => Supplier::class,
                "query_builder" => function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.name');
                },
                "choice_label" => 'name',
                "multiple"=>false,
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-success']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
