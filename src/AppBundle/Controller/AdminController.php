<?php

namespace AppBundle\Controller;

use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\User;

class AdminController extends BaseAdminController

{


    public function registerAction(UserPasswordEncoderInterface $encoder, User $user)
    {
        // whatever *your* User object is
        $plainPassword = $user->getPlainPassword();
        $encoded = $encoder->encodePassword($user, $plainPassword);

        $user->setPassword($encoded);
    }

}

?>
