<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public   function workedSuperviseur($startDate=null, $endDate=null,$all=false){

        $qb = $this->createQueryBuilder('u')->innerJoin('u.commendes','c')->innerJoin('c.pointVente','p')->innerJoin('c.lignes','l');
         if($startDate!=null){
              $qb->andWhere('c.date is null or c.date>=:startDate')->setParameter('startDate', new \DateTime($startDate));
          }
          if($endDate!=null){
             $qb->andWhere('c.date is null or c.date<=:endDate')->setParameter('endDate',new \DateTime($endDate));
          }     
         $qb->select('u.id')
         ->addSelect('u.username')
         ->addSelect('sum(l.quantite) as nombre')
         ->addSelect('count(DISTINCT p.id) as nombrefs')
         ->addGroupBy('u.id')
         ->addGroupBy('u.username');
        return $qb->getQuery()->getArrayResult(); 
  }
}
