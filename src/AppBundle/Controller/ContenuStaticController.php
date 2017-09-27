<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 18/09/2017
 * Time: 20:54
 */

namespace AppBundle\Controller;

use AppBundle\Entity\ContenuStatic;
use AppBundle\Entity\Emplacement;
use AppBundle\Form\ContenuStaticType;
use AppBundle\Form\ContenuStaticEditType;
use AppBundle\Form\EmplacementType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContenuStaticController extends Controller
{
    /**
     * @Method({"GET","POST"})
     * @Route("/admin/contenu/ajouter", name="addContenu")
     */
    public function addContenuAction(Request $request)
    {
        $contenuStatic = new ContenuStatic();
        $form = $this->createForm(ContenuStaticType::class, $contenuStatic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contenuStatic);
            $em->flush();

            $request->getSession()->getFlashbag()->add('success', 'Le nouveau contenu a été enregistré.');
            return $this->redirectToRoute('homepage');
        }
        return $this->render(
            'admin/contenuStatic/addContenu.html.twig', array('form' => $form->createView(),
            )
        );

    }

    /**
     * tableau de gestion du contenu static
     * @Route("/admin/contenu", name="listcontenu")
     * @Method("GET")
     */
    public function listContenuAction()
    {
        $listContenu = $this->getDoctrine()->getRepository("AppBundle:ContenuStatic")->findAll();
        return $this->render('admin/contenuStatic/listContenu.html.twig', array('listContenu' => $listContenu));
    }


    /**
     * @Route("/admin/contenu/{id}/modifier", name="modifContenu")
     * @Method({"GET", "POST"})
     */
    public function modifContenuAction(Request $request, ContenuStatic $contenuStatic)
    {

        $request->headers->get('referer');
        $entityManager = $this->getDoctrine()->getManager();
        $formEdit = $this->createForm(ContenuStaticEditType::class, $contenuStatic);
        $formEdit->handleRequest($request);

        if ($formEdit->isSubmitted() && $formEdit->isValid()) {

            $entityManager->flush();
            $this->addFlash('success', 'Contenu modifié avec succès');
            return $this->redirectToRoute('listcontenu');

        }

        return $this->render(
            'admin/contenuStatic/addContenu.html.twig', [
                'contenuStatic' => $contenuStatic,
                'form' => $formEdit->createView(),
            ]
        );
    }


}
