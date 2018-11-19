<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Inscrit;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class EntityListener
{
    private $tokenStorage;


    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;

    }

    public function prePersist(LifeCycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();


        if (method_exists($entity, 'setAuthor')) {
            $user = $this->tokenStorage->getToken()->getUser();
            $entity->setAuthor($user);
        }
        if (method_exists($entity, 'setUpdateAt')) {
            $entity->setUpdateAt(new DateTime());
        }
	 if ($entity instanceof Inscrit){
            $repository = $em->getRepository('AppBundle:CategorieAge');
            $competition = $entity->getCompetition();
            $today = new DateTime();
            $yearToday = $today->format('Y');

           if($competition->getDate()->format('m') < 9) {
               $yearDebutSaison = $yearToday - 1;
           }
           else{
               $yearDebutSaison = $yearToday;
           }
            $dateDebutSaison = new DateTime($yearDebutSaison.'-09-01');
            $age = $entity->getDateNaissance()->diff($dateDebutSaison);
            $age = $age->format('%Y');
	    if($age < 4){
		$entity->setCategorieAge($repository->find(1));
		}
	    else{
            $categorieAge = $repository->selectAgeCategory($age);
            $entity->setCategorieAge($categorieAge);
		 }
     	 }
    }
}
