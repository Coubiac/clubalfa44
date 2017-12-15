<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Licence;
use AppBundle\Form\LicenceType;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class LicenceController extends Controller
{
    /**
     * @Route("/", name = "index")
     * @Method({"GET", "POST"})
     * @param Request          $request
     * @param SessionInterface $session
     * @return Response
     */
    public function indexAction(Request $request, SessionInterface $session)
    {
        $licence = new Licence();
        $form = $this->createForm(LicenceType::class, $licence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('categorieCalculator')->setCategorie($licence);
            $session->set('licence', $licence);
            return $this->render('default/summary.html.twig', array(
                'order' => $order));
        }
        return $this->render('default/index.html.twig', array(
            'order' => $order,
            'form' => $form->createView(),
        ));
    }
}
