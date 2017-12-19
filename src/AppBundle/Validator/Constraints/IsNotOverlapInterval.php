<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * Permet de s'assurer que deux catégories d'age ne se chevauchent pas (pour que l'attribution automatique fonctionne correctement)
 */
class IsNotOverlapInterval extends Constraint
{
    public $message = "L'interval entre l'age mini et maxi entre en conflit avec une autre catégorie";

    public function validatedBy()
    {
        return IsNotOverlapIntervalValidator::class;
    }


    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
