<?php
namespace AppBundle\Controller;

use AppBundle\Entity\ContenuStatic;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;


class AdminController extends EasyAdminController
{

    public function createNewForm($entity, array $entityProperties)
    {
        $editForm = parent::createNewForm($entity, $entityProperties);
        if ($entity instanceof ContenuStatic) {





            $editForm->remove('emplacement');
            $editForm->add('emplacement', EntityType::class, array(
                'class' => 'AppBundle:ContenuStaticEmplacement',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('emplacement')
                        ->where("emplacement.contenuStatic IS NULL")
                        ->orderBy('emplacement.name', 'ASC');

                },
                'choice_label' => 'name',


            ));
        }

        return $editForm;
    }
}
