<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContenuStaticEmplacement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Constraints\DateTime;


class ContenuStaticController extends Controller
{
    /**
     * @Method("GET")
     * @Route("/", name="homepage", schemes={"https"})
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

        return $this->render('contenuStatic/index.html.twig', array(
            'contenu' => $contenu,
        ));
    }

    /**
     * @Method("GET")
     * @Route("/club/staff", name="staff", schemes={"https"})
     */
    public function staffAction()
    {
        return $this->render('contenuStatic/staff.html.twig');
    }

    /**
     * @Method("GET")
     * @Route("/palmares", name="palmares", schemes={"https"})
     */
    public function palmaresAction()
    {
        $champions = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Champion')
            ->findAll();

        return $this->render('palmares/champions.html.twig', array(
            'champions' => $champions,
        ));
    }

    /**
     * @Method("GET")
     * @Route("/historique", name="historique", schemes={"https"})
     */
    public function historiqueAction()
    {
        $evenementHistorique = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:EvenementHistorique')
            ->findAll();

        return $this->render('EvenementHistorique/evenementHistorique.html.twig', array(
            'evenementHistoriques' => $evenementHistorique,
        ));
    }



    /**
     * @Method("GET")
     * @Route("/{parent}/{enfant}", name="page-statique", schemes={"https"})
     */
    public function pageStatiqueAction($parent, $enfant)
    {
        $url = '/' . $parent . '/' . $enfant;
        if (
        $emplacement = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:ContenuStaticEmplacement')
            ->findOneBy(array('url' => $url))) {
            $contenu = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:ContenuStatic')
                ->findOneBy(array('emplacement' => $emplacement));

            return $this->render('contenuStatic/page-statique.html.twig', array(
                'contenu' => $contenu,
                'emplacement' => $emplacement,
            ));
        } else {
            return $this->redirectToRoute('homepage');
        }


    }

    /**
     * Génère le sitemap du site.
     * @Method("GET")
     * @Route("/sitemap.{_format}", name="front_sitemap", Requirements={"_format" = "xml"})
     */
    public function siteMapAction()
    {
        $emplacements = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:ContenuStaticEmplacement')
            ->findAll();
        $urls = [];

        foreach ($emplacements as $emplacement) {
            $url = $emplacement->getUrl();
            $contenu = $emplacement->getContenuStatic();
            $absoluteUrl = 'https://www.clubalfa44.com' . $url;
            if($contenu){
                $lastmod = $contenu->getLastMod();
            }

            $urls[] = array(
                'loc' => $absoluteUrl,
                'lastmod' => $lastmod,
                'priority' => $emplacement->getPriority()
            );
        }

        return $this->render(
            'sitemap.xml.twig',
            ['urls' => $urls]
        );
    }

}
