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
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * Promote User
     * Méthode pour promouvoir un user
     * @Route("/admin/users/{username}/promote", name="promoteUser")
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
     * @Route("/admin/users/{username}/demote", name="demoteUser")
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
