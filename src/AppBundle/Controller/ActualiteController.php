<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 08/11/2017
 * Time: 14:53
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ActualiteController extends Controller
{

    /**
     * @Route("/actualites", name="actualites")
     */
    public function actualitesAction()
    {
        $actualites = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Actualite')
            ->findAll();

        return $this->render('actualites/actualites.html.twig', array(
            'actualites' => $actualites,
        ));
    }

}
