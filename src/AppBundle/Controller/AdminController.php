<?php
namespace AppBundle\Controller;

use AppBundle\Entity\ContenuStatic;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;


class AdminController extends EasyAdminController
{

    public function createEditForm($entity, array $entityProperties)
    {
        $editForm = parent::createEditForm($entity, $entityProperties);
        if ($entity instanceof ContenuStatic) {





            $editForm->remove('emplacement');
            $editForm->add('emplacement', EntityType::class, array(
                'class' => 'AppBundle:ContenuStaticEmplacement',
                'query_builder' => function (EntityRepository $er) {
                    return $er->getUnassignedEmplacement();

                },
                'choice_label' => 'name',


            ));
        }

        return $editForm;
    }
}
