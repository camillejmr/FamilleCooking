<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,['label'=> ' ','attr' => array(
                'placeholder' => 'Titre de la recette'),])
            ->add('description', null,['label' => ' ', 'attr' => array(
                'placeholder' => 'Description de la recette'),])
            ->add('preparationTime', null,['label' => ' ', 'attr' => array(
                'placeholder' => 'Temps de préparation'),])
            ->add('cookingTime', null,['label' => ' ', 'attr' => array(
                'placeholder' => 'Temps de cuisson'),])
            ->add('restTime', null,['label' => ' ', 'attr' => array(
                'placeholder' => 'Temps de repos'),])
            ->add('totalTime', null,['label' => ' ', 'attr' => array(
                'placeholder' => 'Temps total'),])
            ->add('quantity', null,['label' => ' ', 'attr' => array(
                'placeholder' => 'Quantité / nombre de parts'),])
            ->add('category', EntityType::class,['label' => ' ',
                'class'=>Category::class, 'choice_label'=>'nomCategory',
        'attr' => array(
                'placeholder' => 'Sucré ou salé'),])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
