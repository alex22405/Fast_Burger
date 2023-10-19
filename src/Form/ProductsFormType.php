<?php

namespace App\Form;

use App\Entity\Products;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProductsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product_name', options:[
                'label' => 'Nom',
                'required' => true,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9\s\-_]+$/',
                        'message' => 'Le nom du produit ne peut contenir que des lettres, des chiffres, des espaces, des tirets et des underscores.'
                    ])],
            ])
            ->add('prix', IntegerType::class, [ // IntegerType pour les nombres entiers
                'label' => 'Prix en Franc Guinéen',
                'required' => true
                ])
            ->add('images', FileType::class, [
                    'label' => false,
                    'multiple' => true,
                    'mapped' => false,
                    'required' => false,
                ])
            ->add('product_description', options:[
                'label' => 'Description',
                'required' => true
            ])
            ->add('category', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'name',
                'label' => 'Catégorie'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
