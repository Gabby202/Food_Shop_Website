<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('image')
            ->add('category', EntityType::class, [
                // list objects from this class
                'class' => 'App:Category',
                // use the 'Category.name' property as the visible option string
                'choice_label' => 'name',
            ])
            ->add('price', EntityType::class, [
                // list objects from this class
                'class' => 'App:Price',
                // use the 'Category.name' property as the visible option string
                'choice_label' => 'range',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Product::class,
        ]);
    }
}