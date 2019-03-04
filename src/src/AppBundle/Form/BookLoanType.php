<?php

namespace AppBundle\Form;

use AppBundle\Entity\BookExemplar;
use AppBundle\Entity\BookLoan;
use AppBundle\Entity\Member;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookLoanType extends AbstractType
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
                'class' => BookExemplar::class,
                'choice_label' => 'id'
            ])
            ->add('member', EntityType::class, [
                'label' => 'Lid',
                'class' => Member::class,
                'choice_label' => 'name'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data' => BookLoan::class,
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
