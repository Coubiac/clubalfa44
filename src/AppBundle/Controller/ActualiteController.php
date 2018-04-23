<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 08/11/2017
 * Time: 14:53
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Actualite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ActualiteController extends Controller
{
    /**
     * @Route("/actualites", defaults={"page": "1", "_format"="html"}, name="actualites")
     * @Route("/actualites/page/{page}", defaults={"_format"="html"}, requirements={"page": "[0-9]\d*"}, name="actualites_paginated")
     * @Method("GET")
     */
    public function listActualitesAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }
        // On récupère notre objet Paginator
        $actualites = $this->getDoctrine()->getManager()->getRepository('AppBundle:Actualite')->getActualitesPaginated($page);
        // On calcule le nombre total de pages grâce au count($actualites) qui retourne le nombre total d'Actualites
        $nbPages = ceil(count($actualites) / Actualite::NUM_ITEMS);
        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }
        // On donne toutes les informations nécessaires à la vue
        return $this->render('actualites/actualites.html.twig', array(
                'actualites' => $actualites,
                'nbPages' => $nbPages,
                'page' => $page,
            )
        );
    }

    /**
     * Display Evenement content
     * @Route("/actualites/{slug}", name="actualite")
     * @Route("/actualites/{id}", name="actualiteId")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewActualiteAction(Actualite $actualite)
    {
        return $this->render('actualites/actualite.html.twig', array(

                'actualite' => $actualite
            )
        );
    }


    /**
     * Génère le flux rss
     * @Method("GET")
     * @Route("/rss-actus.{_format}", name="actu-rss", Requirements={"_format" = "xml"})
     */
    public function rssActuAction()
    {
        $actualites = $this->getDoctrine()->getRepository(Actualite::class)->findAll();

        return $this->render(
            'actualites/actualites.xml.twig',
            ['actualites' => $actualites]
        );
    }



}
