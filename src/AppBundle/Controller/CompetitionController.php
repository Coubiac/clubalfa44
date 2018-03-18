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
     * @Method({"GET", "POST"})
     * @Route("/competition", name="competitions")
     */
    public function competitionsAction()
    {
        $competitions = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Competition')
            ->findAll();

        return $this->render('competitions/competitions.html.twig', array(
            'competitions' => $competitions,
        ));
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
        $form = $this->createForm(InscritType::class, $inscrit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $inscrit->setDateInscription(new \DateTime());
            $inscrit->setCompetition($competition);

            $em->persist($inscrit);
            $em->flush();
            $request->getSession()->getFlashbag()->add('success', 'Votre inscription a été enregistré.');
            return $this->redirectToRoute('competitions');
        }
        return $this->render(
            //On affiche  une vue twig simple (pas de head ni rien, donc aucun héritage de template...) qui sera intégrée dans la modale.
            'competitions/competitionModale.html.twig', array('form' => $form->createView(), 'competition' => $competition
            )
        );
    }

}
