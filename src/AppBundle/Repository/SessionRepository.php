<?php

namespace AppBundle\Repository;

/**
 * SessionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SessionRepository extends \Doctrine\ORM\EntityRepository
{

   /**
  *Nombre de synchro effectue par utilisateur 
  */
  public function findList($start){
    $qb = $this->createQueryBuilder('s')->orderBy('s.nomConcours', 'asc'); 
    $query=$qb->getQuery();
    $query->setFirstResult($start)->setMaxResults(8);
     return $query->getResult();
}

    function findByUser($session, $uid){
       $qb =$this->createQueryBuilder('a')->where('a.id=:session') ->setParameter('session', $session) ->leftJoin('a.infos', 'i');
        return   $qb
             ->andWhere('i.uid=:uid')  ->setParameter('uid', $uid) 
            ->getQuery()
            ->getResult();
    }
}
