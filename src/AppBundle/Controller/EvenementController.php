<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 08/11/2017
 * Time: 14:53
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

}
