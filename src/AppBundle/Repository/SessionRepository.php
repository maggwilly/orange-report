<?php

namespace AppBundle\Repository;
use Pwm\AdminBundle\Entity\Info;
use AppBundle\Entity\Session;
use AppBundle\Entity\User;
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
  public function findList($start,$all,$order=null){
    $qb = $this->createQueryBuilder('s')->where('s.archived=:archived')->setParameter('archived',false);
    switch ($order) {
      case 'dateLancement':
        $qb ->orderBy('s.dateLancement', 'desc'); 
        break;
      case 'nombreInscrit':
        $qb ->orderBy('s.nombreInscrit', 'desc'); 
        break;      
      default:
         $qb ->orderBy('s.nomConcours', 'asc'); 
        break;
    }
   
    $query=$qb->getQuery();
      if($all!='true')
    $query->setFirstResult($start)->setMaxResults(8);
     return $query->getResult();
}


    function findByUser($session, $uid){
       $qb =$this->createQueryBuilder('a')
       ->where('a.id=:session') ->setParameter('session', $session) ->leftJoin('a.infos', 'i');
        return   $qb->andWhere('i.uid=:uid')  ->setParameter('uid', $uid)->getQuery()->getResult();
    }

    /**
  *Nombre de synchro effectue par utilisateur 
  */
  public function findRecents(){
    $qb = $this->createQueryBuilder('s')->orderBy('s.dateLancement', 'desc')
    ->where('s.archived=:archived and s.dateLancement is not NULL')->setParameter('archived',false); 
    $query=$qb->getQuery();
    $query->setFirstResult(0)->setMaxResults(3);
     return $query->getResult();
} 

  public function findOwards(){
    $qb = $this->createQueryBuilder('s')->orderBy('s.dateLancement', 'desc')
    ->where('s.archived=:archived and s.dateLancement is not NULL')->setParameter('archived',false)
    ->andWhere('s.type=:type')
    ->setParameter('type','owards'); 
    $query=$qb->getQuery();
   // $query->setFirstResult(0)->setMaxResults(3);
     return $query->getResult();
}
     /**
  *Nombre de synchro effectue par utilisateur 
  */
  public function findEnVus(){
    $qb = $this->createQueryBuilder('s')->orderBy('s.nombreInscrit', 'desc')->where('s.archived=:archived')->setParameter('archived',false); 
    $query=$qb->getQuery();
    $query->setFirstResult(0)->setMaxResults(4);
     return $query->getResult();
} 

     /**
  *Nombre de synchro effectue par utilisateur 
  */
  public function findForUser(Info $user){
    $qb = $this->createQueryBuilder('s')->where('s.archived=:archived and s.dateLancement is not NULL')->setParameter('archived',false)
    ->andWhere('s.niveau=:niveau')->setParameter('niveau', $user->getNiveau())
    ->andWhere('s.serie=:serie')->setParameter('serie', $user->getSerie())
    ->andWhere('s.dateMax>=:dateMax')->setParameter('dateMax', $user->getDateMax())
    ->orderBy('s.nomConcours', 'asc'); 
    $query=$qb->getQuery();
    $query->setFirstResult(0)->setMaxResults(4);
     return $query->getResult();
} 

      function findListByUser(User $user){
       $qb =$this->createQueryBuilder('a')->where('a.user=:user')->setParameter('user',$user);
        return   $qb->getQuery()->getResult();
    } 

        public function findAll(){
         $qb = $this->createQueryBuilder('s')
         ->where('s.archived=:archived')->setParameter('archived',false); 
          return $qb->getQuery()->getResult();
  } 
}
