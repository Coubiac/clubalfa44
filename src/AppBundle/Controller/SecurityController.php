<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;


class SecurityController extends BaseAdminController
{
    /**
     * Promote User
     * Méthode pour promouvoir un user
     * @Route("/admin/users/{username}/promote", name="promoteUser", schemes={"https"})
     * @Method("POST")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function promoteUserAction()
    {
        $id = $this->request->query->get('id');
        $user = $this->em->getRepository('AppBundle:User')->find($id);


        if (!$user->isSuperAdmin() && !$user->hasRole("ROLE_ADMIN")) // Un super Admin a déja les permissions maximales
        {
            $user->addRole("ROLE_ADMIN");
            $this->em->persist($user);
            $this->em->flush();
        }
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => $this->request->query->get('entity'),
        ));
    }

    /**
     * Demote User
     *
     * @Route("/admin/users/{username}/demote", name="demoteUser", schemes={"https"})
     * @Method("POST")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function demoteUserAction()
    {
        $id = $this->request->query->get('id');
        $user = $this->em->getRepository('AppBundle:User')->find($id);

        if (!$user->isSuperAdmin()) // On ne touche pas aux super admins
        {
            $user->removeRole("ROLE_ADMIN");
            $this->em->persist($user);
            $this->em->flush();
        }
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => $this->request->query->get('entity'),
        ));
    }
}
