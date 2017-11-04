<?php

namespace AppBundle\EventListener;

use DateTime;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class EntityListener
{
    private $tokenStorage;
    private $encoder;

    public function __construct(TokenStorageInterface $tokenStorage, UserPasswordEncoderInterface $encoder)
    {
        $this->tokenStorage = $tokenStorage;
        $this->encoder = $encoder;
    }

    public function prePersist(LifeCycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $user = $this->tokenStorage->getToken()->getUser();
        if (method_exists($entity, 'setAuthor')) {
            $entity->setAuthor($user);
        }
        if (method_exists($entity, 'setUpdatedAt')) {
            $entity->setUpdatedAt(new DateTime());
        }

        if (method_exists($entity, 'getPlainPassword')){
            $plainPassword = $entity->getPlainPassword();
            if (0 !== strlen($plainPassword)) {
                $encoded = $this->encoder->encodePassword($entity, $plainPassword);
                $entity->setPassword($encoded);
            }

        }
        if (method_exists($entity, 'setUsername')) {
            $entity->setUsername();
        }


    }
}
