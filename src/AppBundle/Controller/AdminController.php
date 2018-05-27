<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContenuStatic;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class AdminController extends EasyAdminController
{
    protected function persistEntity($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    protected function updateEntity($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    protected function removeEntity($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }

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

    /**
     * @return mixed
     */
    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    /**
     * @param $user
     */
    public function prePersistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    /**
     * @param $user
     */
    public function preUpdateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    /**
     * Fonction d'export Excel des inscriptions competition
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportInscriptionsAction()
    {
        $id = $this->request->query->get('id');
        $competition = $this->em->getRepository('AppBundle:Competition')->find($id);
        $inscrits = $competition->getInscrits();
        // On appel de service de création de fichier Excel
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
        $this->get('app.export_inscription')->export($phpExcelObject, $inscrits);
        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'liste-inscrits.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);
        return $response;
    }

    /**
     * Fonction d'envoie de notification  web push pour les actualités
     * @return string
     */
    public function sendActualiteNotificationAction()
    {
        $id = $this->request->query->get('id');
        $actualite = $this->em->getRepository('AppBundle:Actualite')->find($id);
        $absoluteUrl = $this->generateUrl('actualite', array('slug' => $actualite->getSlug()), UrlGeneratorInterface::ABSOLUTE_URL);

        // On appel de service d'envoie de notification
        $response = $this->get('app.pushNotification')->sendMessage(array('All'), $actualite->getTitre(), $absoluteUrl);
        $data = json_decode($response, true);
        $recipients = $data["recipients"];
        $message = 'La notification a été envoyée à '. $recipients . ' destinataires';
        $this->addFlash('info', $message);

        return parent::showAction();
    }
}
