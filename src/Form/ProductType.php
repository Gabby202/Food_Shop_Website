<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', \Symfony\Component\Form\Extension\Core\Type\HiddenType::class)
            ->add('title')
            ->add('summary')
            ->add('image', FileType::class, [
                'label' => 'Brochure (PDF file)',
                'data_class' => null,
                'required' => false
            ])
            ->add('description')
            ->add('ingredients')
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