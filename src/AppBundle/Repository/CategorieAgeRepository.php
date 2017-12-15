<?php

namespace AppBundle\Repository;

/**
 * CategorieAgeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategorieAgeRepository extends \Doctrine\ORM\EntityRepository
{
    public function selectAgeCategory($age){
        $qb = $this->createQueryBuilder('c');

        $qb->where('c.ageMin <= :age')
            ->andWhere('c.ageMax >= :age')
            ->setParameter('age', $age)
        ;
        return $qb->getQuery()->getSingleResult();
    }
}
