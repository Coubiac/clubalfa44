<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Competition;
use AppBundle\Entity\Inscrit;
use AppBundle\Form\InscritType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CompetitionController extends Controller
{

    /**
     * @Route("/competition", defaults={"page": "1", "_format"="html"}, name="competitions")
     * @Route("/competition/page/{page}", defaults={"_format"="html"}, requirements={"page": "[0-9]\d*"}, name="competitions_paginated")
     * @Method("GET")
     */
    public function listCompetitionsAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }
        // On récupère notre objet Paginator
        $competitions = $this->getDoctrine()->getManager()->getRepository('AppBundle:Competition')->getCompetitionsPaginated($page);
        // On calcule le nombre total de pages grâce au count($competitions) qui retourne le nombre total de competitions
        $nbPages = ceil(count($competitions) / Competition::NUM_ITEMS);
        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }
        // On donne toutes les informations nécessaires à la vue
        return $this->render('competitions/competitions.html.twig', array(
                'competitions' => $competitions,
                'nbPages' => $nbPages,
                'page' => $page,
            )
        );
    }







    /**
     * Display Competition content
     * @Route("/competition/{id}/photo", name="competitionPhotos")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewCompetitionPhotosAction(Competition $competition)
    {
        $photos = $this->getDoctrine()->getRepository("AppBundle:Photo")->findBy(
            array('competition' => $competition)
        );
        return $this->render('competitions/competition.html.twig', array(

                'photos' => $photos,
                'competition' => $competition
            )
        );
    }


    /**
     * @Method({"GET", "POST"})
     * @Route("/competition/{id}/inscription", name="competition-inscription")
     * @param Request $request
     */
    public function inscriptionAction(Competition $competition, Request $request)
    {
        $inscrit = new Inscrit();
        $inscrit->setCompetition($competition);
        $form = $this->createForm(InscritType::class, $inscrit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $inscrit->setDateInscription(new \DateTime());

            $em->persist($inscrit);
            $em->flush();
            $request->getSession()->getFlashbag()->add('success', 'Votre inscription a été enregistré.');
            return $this->redirectToRoute('competitions');
        }
        if ($form->isSubmitted() && !$form->isValid()){
            $message = (string) $form->getErrors(true, false);

            $request->getSession()->getFlashbag()->add('danger', $message );
            return $this->redirectToRoute('competitions');

        }
        return $this->render(
            //On affiche  une vue twig simple (pas de head ni rien, donc aucun héritage de template...) qui sera intégrée dans la modale.
            'competitions/competitionModale.html.twig', array('form' => $form->createView(), 'competition' => $competition
            )
        );
    }

}
