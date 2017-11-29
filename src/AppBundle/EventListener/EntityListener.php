<?php

namespace AppBundle\EventListener;

use DateTime;
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

        if (method_exists($entity, 'setAuthor')) {
            $user = $this->tokenStorage->getToken()->getUser();
            $entity->setAuthor($user);
        }
        if (method_exists($entity, 'setUpdateAt')) {
            $entity->setUpdateAt(new DateTime());
        }

    }
}
