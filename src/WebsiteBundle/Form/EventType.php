<?php

namespace WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'choice',
                'attr' => array(
                    'class' => 'form-control'
                )
                ))
                
            ->add('venue')
             ->add('band', EntityType::class, array(
                    // query choices from this entity
                    'class' => 'WebsiteBundle:Band',
                   'query_builder' => function (EntityRepository $er) {
                          return $er->createQueryBuilder('u')
                                  ->orderBy('u.title', 'ASC');
                          },
                 'choice_label' => 'title',

    // used to render a select box, check boxes or radios
    // 'multiple' => true,
    // 'expanded' => true,
));
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WebsiteBundle\Entity\Event'
        ));
    }
}
