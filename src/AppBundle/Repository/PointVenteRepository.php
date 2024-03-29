<?php

namespace AppBundle\Repository;
use AppBundle\Entity\User; 
/**
 * PointVenteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PointVenteRepository extends \Doctrine\ORM\EntityRepository
{
		  public function findByUserVille(User $user=null, $region=null){
           $qb = $this->createQueryBuilder('p')->join('p.user','u');
        if($user!=null){
             $qb  ->andWhere('p.user=:user')->setParameter('user', $user);
          }
        if($region!=null){
              $qb->andWhere('p.ville=:ville')->setParameter('ville', $region);
          }
         return $qb->getQuery()->getResult();  
       }

	
}
