<?php

namespace Pwm\MessagerBundle\Repository;

/**
 * PubRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PubRepository extends \Doctrine\ORM\EntityRepository
{
		  /**
  *Nombre de synchro effectue par utilisateur 
  */
  public function findList(){
         $qb = $this->createQueryBuilder('a')
         ->andWhere('a.startDate<=:today')  ->andWhere('a.endDate>=:today')
         ->setParameter('today',new \DateTime())
         ->orderBy('a.startDate', 'desc'); 
         $query=$qb->getQuery();
         $query->setFirstResult(0)->setMaxResults(5);
          return $query->getResult();
  }
}
