<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\Licence;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CheckAgeMiniValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Licence $licence
     * @param Constraint $constraint
     */
    public function validate($licence, Constraint $constraint)
    {
        $ageMini = $licence->getActivite()->getAgeMini();
        $saison = $licence->getSaison();

        // On calcul l'age qu'aura le licencié en début de saison
        $age = $saison->getDateDebut()->format('Y') - $licence->getBirthDate()->format('Y');


        if ($age < $ageMini)
        {
            $this->context
                ->buildViolation($constraint->message)
                ->atPath('birthdate')
                ->addViolation();
        }
    }
}
