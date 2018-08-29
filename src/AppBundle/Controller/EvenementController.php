<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 08/11/2017
 * Time: 14:53
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Evenement;
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
     * @Route("/prochaines-evenement", defaults={"page": "1", "_format"="html"}, name="new-evenements")
     * @Route("/evenement/page/{page}", defaults={"_format"="html"}, requirements={"page": "[0-9]\d*"}, name="evenements_paginated")
     * @Method("GET")
     */
    public function listProchainesEvenementsAction(Request $request, $page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }
        // On récupère notre objet Paginator
        $evenements = $this->getDoctrine()->getManager()->getRepository('AppBundle:Evenement')->getFutureEvenementPaginated($page);
        // On calcule le nombre total de pages grâce au count($evenements) qui retourne le nombre total de evenements
        $nbPages = ceil(count($evenements) / Evenement::NUM_ITEMS);
        if ($nbPages < 1){
            $request->getSession()->getFlashbag()->add('error', "Il n'y a pas de nouveaux évènements pour le moment");
            return $this->redirectToRoute ("old-evenements");

        }
        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }
        // On donne toutes les informations nécessaires à la vue
        return $this->render('evenements/evenements.html.twig', array(
                'evenements' => $evenements,
                'nbPages' => $nbPages,
                'page' => $page,
            )
        );
    }

    /**
     * @Route("/evenements-archives", defaults={"page": "1", "_format"="html"}, name="old-evenements")
     * @Route("/old-evenement/page/{page}", defaults={"_format"="html"}, requirements={"page": "[0-9]\d*"}, name="old-evenements_paginated")
     * @Method("GET")
     */
    public function listArchiveEvenementsAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }
        // On récupère notre objet Paginator
        $evenements = $this->getDoctrine()->getManager()->getRepository('AppBundle:Evenement')->getArchivedEvenementPaginated($page);
        // On calcule le nombre total de pages grâce au count($evenements) qui retourne le nombre total de evenements
        $nbPages = ceil(count($evenements) / Evenement::NUM_ITEMS);
        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page " . $page . " n'existe pas.");
        }
        // On donne toutes les informations nécessaires à la vue
        return $this->render('evenements/evenements.html.twig', array(
                'evenements' => $evenements,
                'nbPages' => $nbPages,
                'page' => $page,
            )
        );
    }

    /**
     * @Method("POST")
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
            return $this->redirectToRoute("new-evenements");
        }

        $evenement->addInscrit($user);
        $em->persist($evenement);
        $em->flush();


        $request->getSession()->getFlashbag()->add('success', "Merci ! Votre inscription a été prise en compte !");
        return $this->redirectToRoute("new-evenements");


    }

    /**
     * Display Evenement content
     * @Route("/evenements/{slug}/photos", name="evenementPhotos")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewEvenementPhotosAction(Evenement $evenement)
    {
        $photos = $this->getDoctrine()->getRepository("AppBundle:Photo")->findBy(
            array('evenement' => $evenement)
        );
        return $this->render('evenements/evenement.html.twig', array(

                'photos' => $photos,
                'evenement' => $evenement
            )
        );
    }

}
