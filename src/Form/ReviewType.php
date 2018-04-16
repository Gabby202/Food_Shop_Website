<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('username', \Symfony\Component\Form\Extension\Core\Type\HiddenType::class)
            ->add('description')
            ->add('rating')
            ->add('price')
            ->add('retailers')
            ->add('product', EntityType::class, [
                // list objects from this class
                'class' => 'App:Product',
                // use the 'Category.name' property as the visible option string
                'choice_label' => 'title',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
