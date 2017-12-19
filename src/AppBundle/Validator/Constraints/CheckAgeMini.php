<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * Permet de s'assurer que le licencié a bien l'age mini pour pratiquer
 */
class CheckAgeMini extends Constraint
{
    public $message = "Encore trop jeune pour pratiquer cette discipline.";


    public function validatedBy()
    {
        return CheckAgeMiniValidator::class;
    }


    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
