<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 08/11/2017
 * Time: 14:53
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class TarifsController extends Controller
{

    /**
     * @Method("GET")
     * @Route("/tarifs", name="tarifs", schemes={"https"})
     */
    public function tarifsAction()
    {
        return $this->render('tarifs/tarifs.html.twig');
    }

}
