<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContenuStaticType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('emplacement', EntityType::class, array(
            'class' => 'AppBundle:ContenuStaticEmplacement',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('e')->where('e.contenuStatic is empty')->orderBy('e.name', 'ASC');
            },
        ))
            ->add('titre')
            ->add('contenu',CKEditorType::class, array(
                'config_name' => 'default',
            ))

            ->add('enregistrer', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ContenuStatic'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contenustatic';
    }


}
