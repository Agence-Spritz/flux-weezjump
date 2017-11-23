<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ValeurCategorieType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('quantite', TextType::class, array(
                    'mapped' => false,
                    'label' => false,
                    'data' => '1',
                    'attr' => array(
                        'class' => 'form-control text-center'
                    )
                ))
                ->add('creneau', EntityType::class, array(
                    'class' => 'AppBundle:Creneau',
                    'label' => false,
                    'attr' => array(
                        'class' => 'hide hidden'
                    )
                ))
                ->add('categorie', EntityType::class, array(
                    'class' => 'AppBundle:Categorie',
                    'label' => false,
                    'attr' => array(
                        'class' => 'hide hidden'
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ValeurCategorie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_valeurcategorie';
    }

}
