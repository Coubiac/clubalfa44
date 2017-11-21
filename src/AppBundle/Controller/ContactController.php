<?php
namespace AppBundle\Controller;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\ContactMail;
class ContactController extends Controller
{
    /**
     * @Route("/nous-contacter", name="nous_contacter")
     * @Method({"GET","POST"})
     */
    public function contactAction(Request $request, ContactMail $contactMail)
    {
        $choices = $this->getParameter('contactform.form');
        $form = $this->createForm(ContactType::class, $choices);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $contactMail->sendContactMail($data);
            $contactMail->sendContactMailToSender($data);
            $this->addFlash('success', 'Votre message à bien été envoyé. Nous vous répondrons au plus vite.');
            return $this->redirectToRoute('nous_contacter');
        }
        return $this->render(':Contact:contact.html.twig', array('form' => $form->createView()));
    }
}
