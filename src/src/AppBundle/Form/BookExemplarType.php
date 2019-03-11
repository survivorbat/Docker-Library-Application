<?php

namespace AppBundle\Form;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Entity\BookExemplar;
use AppBundle\Entity\BookLoan;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookExemplarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('book', EntityType::class, [
                'label' => 'Boek',
                'class' => Book::class,
                'choice_label' => 'title',
                'attr' => [
                    'class' => 'select2'
                ],
            ])
            ->add('location', EntityType::class, [
                'label' => 'Locatie',
                'class' => Location::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'select2'
                ],
            ])
            ->add('loan', EntityType::class, [
                'label' => 'Verleden uitleningen',
                'class' => BookLoan::class,
                'multiple' => true,
                'choice_label' => 'exemplarNumber',
                'attr' => [
                    'class' => 'select2'
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data' => BookExemplar::class,
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'bookExemplar';
    }
}
