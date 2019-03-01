<?php

namespace AppBundle\Form;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\BookExemplar;
use AppBundle\Entity\BookLoan;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Member;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookLoanType extends FormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateTimeType::class, [
                'label' => 'Startdatum'
            ])
            ->add('dueDate', DateTimeType::class, [
                'label' => 'Inleverdatum'
            ])
            ->add('pastDueFine', NumberType::class, [
                'label' => 'Boete'
            ])
            ->add('bookExemplar', EntityType::class, [
                'label' => 'Boek exemplaar',
                'class' => BookExemplar::class
            ])
            ->add('member', EntityType::class, [
                'label' => 'Lid',
                'class' => Member::class
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BookLoan::class
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'bookLoan';
    }
}