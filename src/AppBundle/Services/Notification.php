<?php

namespace AppBundle\Services;





use AppBundle\Entity\Commande;

class Notification extends \Twig_Extension
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var
     */
    private $twig;


    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;

    }

    public function sendConfirmationAction(Commande $commande){
        $message = \Swift_Message::newInstance()
            ->setSubject('Louvre Museum : Order confirmation')
            ->setFrom(array('noreply@louvre.com' => 'Louvre Museum'))
            ->setTo($commande->getUser()->getEmail())
            ->setBody($this->twig->render('emails/commandeConfirmation.html.twig', array('commande' => $commande)), 'text/html');
        $this->mailer->send($message);
    }

}
