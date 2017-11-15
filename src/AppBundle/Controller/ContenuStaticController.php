<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContenuStaticEmplacement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ContenuStaticController extends Controller
{
    /**
     * @Method("GET")
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $emplacement = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:ContenuStaticEmplacement')
            ->findOneBy(array('name' => 'index'));

        $contenu = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:ContenuStatic')
            ->findOneBy(array('emplacement' => $emplacement));
        dump($contenu);

        return $this->render('contenuStatic/index.html.twig', array(
        'contenu' => $contenu,
    ));
    }

    /**
     * @Method("GET")
     * @Route("/{parent}/{enfant}", name="page-statique")
     */
    public function pageStatiqueAction($parent, $enfant)
    {
        $url = '/' . $parent . '/' . $enfant;
        if(
        $emplacement = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:ContenuStaticEmplacement')
            ->findOneBy(array('url' => $url)))
        {
            $contenu = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:ContenuStatic')
                ->findOneBy(array('emplacement' => $emplacement));

            return $this->render('contenuStatic/page-statique.html.twig', array(
                'contenu' => $contenu,
            ));
    }
    else{
        return $this->redirectToRoute('homepage');
    }


    }

}
