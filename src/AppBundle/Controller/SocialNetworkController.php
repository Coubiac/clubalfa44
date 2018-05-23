<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SocialNetworkController extends Controller
{
    /**
     * @Route("/socialNetwork", name="socialNetwork", schemes={"https"})
     * @Method("GET")
     */
    public function listActualitesAction()
    {

        // On donne toutes les informations nécessaires à la vue
        return $this->render('SocialNetwork/socialNetwork.html.twig');

    }


}
