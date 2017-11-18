<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContenuStatic;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;


class AdminController extends EasyAdminController
{

    /**
     * @param object $entity
     * @param array  $entityProperties
     * @return \Symfony\Component\Form\Form
     */
    public function createEditForm($entity, array $entityProperties)
    {
        $editForm = parent::createEditForm($entity, $entityProperties);
        if ($entity instanceof ContenuStatic) {
            $editForm->remove('emplacement');
        }

        return $editForm;
    }

    /**
     * @param object $entity
     * @param array  $entityProperties
     * @return \Symfony\Component\Form\Form
     */
    public function createNewForm($entity, array $entityProperties)
    {
        $newForm = parent::createNewForm($entity, $entityProperties);
        if ($entity instanceof ContenuStatic) {

            $newForm->remove('emplacement');
            $newForm->add('emplacement', EntityType::class, array(
                'class' => 'AppBundle:ContenuStaticEmplacement',
                'query_builder' => function (EntityRepository $er) {
                    return $er->getUnassignedEmplacement();
                },
                'choice_label' => 'name',
            ));
        }
        return $newForm;
    }
}
