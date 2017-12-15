<?php

namespace AppBundle\Form;

use AppBundle\Entity\Activite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LicenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('codePostal')
            ->add('adresse')
            ->add('ville')
            ->add('birthdate', BirthdayType::class, array(
                'label' => 'Date de Naissance',
                //Permet d'avoir un affichage correct avec Materialize CSS
                'label_attr' => ['class' => 'active'],
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ))
            ->add('saison')
            ->add('activite',EntityType::class, array(
                'class' => Activite::class,
                'label' => "activité",
                'required' => false,
                'placeholder' => 'Choisissez une activité',
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Licence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_licence';
    }


}
