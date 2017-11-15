<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ContenuStaticController extends Controller
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

        return $this->render('contenuStatic/index.html.twig', array(
        'contenu' => $contenu,
    ));
    }

    /**
     * @Method("GET")
     * @Route("/lutte/presentation", name="lutte-presentation")
     */
    public function luttePresentationAction()
    {
        $emplacement = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:ContenuStaticEmplacement')
            ->findOneBy(array('name' => 'lutte-presentation'));
        $contenu = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:ContenuStatic')
            ->findOneBy(array('emplacement' => $emplacement));

        return $this->render('contenuStatic/lutte-presentation.html.twig', array(
            'contenu' => $contenu,
        ));
    }

}
