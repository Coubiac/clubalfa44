<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 08/11/2017
 * Time: 14:53
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class EvenementController extends Controller
{

    /**
     * @Method("GET")
     * @Route("/evenements", name="evenements")
     */
    public function evenementsAction()
    {
        $evenements = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Evenement')
            ->findAll();

        return $this->render('evenements/evenements.html.twig', array(
            'evenements' => $evenements,
        ));
    }

    /**
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     * @Route("/evenement/{id}/inscription", name="evenement-inscription")
     */
    public function inscriptionAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();

        $evenement = $em->getRepository('AppBundle:Evenement')->find($id);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $inscrits = $evenement->getInscrits();

        if($inscrits->contains($user))
        {
            $request->getSession()->getFlashbag()->add('success', "Vous êtes déja iscrit !");
            return $this->redirectToRoute("evenements");
        }

        $evenement->addInscrit($user);
        $em->persist($evenement);
        $em->flush();


        $request->getSession()->getFlashbag()->add('success', "Merci ! Votre inscription a été prise en compte !");
        return $this->redirectToRoute("evenements");


    }

}
