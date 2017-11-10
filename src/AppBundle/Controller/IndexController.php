<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class IndexController extends Controller
{
    /**
     * @Method("GET")
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $contenu = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:ContenuStatic')
            ->findOneBy(array('emplacement' => 'index'));

        return $this->render('default/index.html.twig', array(
        'contenu' => $contenu,
    ));
    }

    /**
     * @Method("GET")
     * @Route("/lutte/presentation", name="lutte-presentation")
     */
    public function luttePresentationAction()
    {
        $contenu = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:ContenuStatic')
            ->findOneBy(array('emplacement' => 'lutte-presentation'));

        return $this->render('default/lutte-presentation.html.twig', array(
            'contenu' => $contenu,
        ));
    }

}
