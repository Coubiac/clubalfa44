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


class PhotoController extends Controller
{

    /**
     * @Method("GET")
     * @Route("/photos", name="photos", schemes={"https"})
     */
    public function photosAction()
    {
        $photos = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Photo')
            ->findAll();

        return $this->render('photos/photos.html.twig', array(
            'photos' => $photos,
        ));
    }

}
