<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Commande;
use AppBundle\Form\CommandeType;
use AppBundle\Form\CommandeLicenceType;
use AppBundle\Manager\CommandeManager;
use AppBundle\Services\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CommandeController extends Controller
{
    private $cm;

    /**
     * CommandeController constructor.
     */
    public function __construct(CommandeManager $cm)
    {
        
        $this->cm = $cm;
    }

    /**
     * @Route("/commande/", name="commande")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function commandeAction(Request $request)
    {
        $commande = $this->cm->createCommande();
        $form = $this->createForm(CommandeType::class, $commande);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->cm->adaptlicences($commande);
            $this->cm->saveCommande($commande);
            
            return $this->redirectToRoute('coordonnees');
        }
        return $this->render('commandes/commande.html.twig', array(
            'form' => $form->createView()
        ));
    }
    /**
     * @Route("/commande/coordonnees/", name="coordonnees")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function coordonneesAction(Request $request)
    {
        $commande = $this->cm->getCommande();

        if ($commande === false)
        {
            return $this->redirectToRoute('commande');
        }






        $form = $this->createForm(CommandeLicenceType::class, $commande);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->get('priceCalculator')->setPrices($commande);

            $this->cm->saveCommande($commande);
            return $this->redirectToRoute('recapCommande', array('commande' => $commande));
        }
        return $this->render('commandes/coordonnees.html.twig', array(
            'commande' => $commande,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/commande/recap/", name="recapCommande")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET"})
     */
    public function recapCommandeAction(Request $request)
    {
        $commande = $this->cm->getCommande();

        if ($commande === false)
        {
            return $this->redirectToRoute('commande');
        }
        $this->cm->setCommandeTotal($commande);
        $commande->setUser($this->getUser());

        $this->cm->saveCommande($commande);


        
        return $this->render('commandes/recapCommande.html.twig', array('commande' => $commande));
    }
    /**
     * @Route("/commande/paiement", name="paiement")
     * @Security("has_role('ROLE_USER')")
     * @Method({"POST"})
     */
    public function paiementAction(Request $request, Notification $notification)
    {
        $commande = $this->cm->getCommande();
        if ($commande === false)
        {
            return $this->redirectToRoute('commande');
        }
        $paymentManager = $this->get('paymentManager');
        if ($paymentManager->checkoutAction($commande, $request)) {
            $notification->sendConfirmationAction($commande);
            $this->cm->flushAndRemoveSession($commande);
            return $this->render('commandes/confirmation.html.twig', array(
                'commande' => $commande));
        }
        return $this->redirectToRoute('recapCommande');
    }

    /**
     * @Route("/commande/validation/{numero}", name="validation")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET"})
     */
    public function validationAction(Commande $commande)
    {
        
        return $this->render("::validation.html.twig", array('commande' => $commande));
    }

}
