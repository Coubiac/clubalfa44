<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ActualiteController extends Controller
{
    /**
     * @Route("/actualites", name="actualites")
     * @Method("GET")
     */
    public function listActualitesAction()
    {

        // On donne toutes les informations nécessaires à la vue
        return $this->render('actualites/actualites.html.twig');

    }


}
