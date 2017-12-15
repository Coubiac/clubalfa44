<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 31/08/2017
 * Time: 19:39
 */
namespace AppBundle\Services;

use AppBundle\Entity\Commande;
use Symfony\Component\HttpFoundation\Request;

class PaymentManager{

    private $stripeSecretKey;

    public function __construct($stripeSecretKey)
    {
        $this->stripeSecretKey = $stripeSecretKey;

    }

    public function checkoutAction(Commande $commande, Request $request){

        $total = $commande->getTotal();
        
        $token = $request->request->get('stripeToken');
        \Stripe\Stripe::setApiKey($this->stripeSecretKey);
        try {
            \Stripe\Charge::create(array(
                "amount" => $total * 100,
                "currency" => "eur",
                "source" => $token,
                "description" => $commande->getNumero()));

            return true;
        }

        catch (\Stripe\Error\Card $e) {
            return false;
        }
    }

}
