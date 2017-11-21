<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 02/06/2017
 * Time: 19:16
 */

namespace AppBundle\Services;




class ContactMail extends \Twig_Extension
{
    private $twig;
    private $mailer;
    private $contacts;
    private $sender;



    public function __construct(\Swift_Mailer $mailer,\Twig_Environment $twig, $contacts, $sender)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
        $this->contacts = $contacts;
        $this->sender = $sender;

    }

    public function sendContactMail($data)
    {

        $recipient = $this->contacts[$data['categorie']];

        $reply = $data['mail'];
        $message = \Swift_Message::newInstance()->setSubject('Formulaire de contact ALFA')
            ->setFrom(array($this->sender => $data['firstName'].' '.$data['name']))
            ->setReplyTo($reply)
            ->setTo([$recipient])
            ->setBody($this->twig->render(
                ':Emails:contactMail.html.twig',
                array(
                    'name' => $data['name'],
                    'firstName' => $data['firstName'],
                    'mail' => $data['mail'],
                    'categorie' => $data['categorie'],
                    'message' => $data['message']
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }

    public function sendContactMailToSender($data)
    {
        $recipient = $this->contacts[$data['categorie']];
        $reply = $data['mail'];
        $message = \Swift_Message::newInstance()->setSubject('Formulaire de contact ALFA')
            ->setFrom(array($this->sender => 'Site ALFA'))
            ->setReplyTo($recipient)
            ->setTo($reply)
            ->setBody($this->twig->render(
                ':Emails:contactMailForSender.html.twig',
                array(
                    'name' => $data['name'],
                    'firstName' => $data['firstName'],
                    'mail' => $data['mail'],
                    'categorie' => $data['categorie'],
                    'message' => $data['message']
                )
            ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}
