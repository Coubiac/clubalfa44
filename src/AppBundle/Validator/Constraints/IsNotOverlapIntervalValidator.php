<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\CategorieAge;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


//Validateur permettant de verifier qu'une nouvelle catégorie d'age ne soit pas en conflit avec une autre déja existente.
class IsNotOverlapIntervalValidator extends ConstraintValidator
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
     * @param CategorieAge $categorieAge
     * @param Constraint $constraint
     */
    public function validate($categorieAge, Constraint $constraint)
    {
        $categorieAges = $this->em->getRepository('AppBundle:CategorieAge')->findAll();

        foreach ($categorieAges as $categorie){

            if($categorieAge->getAgeMax() >= $categorie->getAgeMin() && $categorieAge->getAgeMin() <= $categorie->getAgeMax() && $categorieAge->getId() != $categorie->getId()){
                $this->context
                    ->buildViolation($constraint->message)
                    ->atPath('ageMin')
                    ->addViolation();
            }
        }
    }
}

