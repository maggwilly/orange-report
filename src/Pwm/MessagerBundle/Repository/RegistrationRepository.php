<?php

namespace Pwm\MessagerBundle\Repository;
use Pwm\MessagerBundle\Entity\Notification;
/**
 * DistRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RegistrationRepository extends \Doctrine\ORM\EntityRepository
{
	  public function findNotsingup(){
         $qb = $this->createQueryBuilder('r')
         ->where('r.info is NULL'); 
          return $qb->getQuery()->getResult();
  }
	 
	 public function findTooLongTimeLogin(){
	 	$delay=new \DateTime();
	 	$delay->modify('-15 day');
         $qb = $this->createQueryBuilder('r')
         ->where('r.latLoginDate>=:latLoginDate') ->setParameter('latLoginDate',$delay); 
          return $qb->getQuery()->getResult();
  }

    public function findAll(){
         $qb = $this->createQueryBuilder('r')
         ->where('r.isFake is NULL'); 
          return $qb->getQuery()->getResult();
  }
   
      public function findAllIds(){
         $qb = $this->createQueryBuilder('r')
         ->where('r.isFake is NULL')->select('r.registrationId'); 
          return $qb->getQuery()->getArrayResult();
  } 
        /**
  *Nombre de synchro effectue par utilisateur 
  */
  public function findByUsers($uids){
         $qb = $this->createQueryBuilder('a')
         -> where('a.info IN (:uids)')->setParameter('uids', $uids);
          return $qb->getQuery()->getResult();
  }

        /**
  *Nombre de synchro effectue par utilisateur 
  */
  public function findByRegistrationIds($registrationIds=array()){
         $qb = $this->createQueryBuilder('a')
         -> where('a.registrationId IN (:registrationIds)')->setParameter('registrationIds', $registrationIds)
         ->andWhere('r.isFake is NULL');
          return $qb->getQuery()->getResult();
  }


  public function findNotReadsDesc(Notification $notification=null){
         $qb = $this->createQueryBuilder('r')->join('sending')
         ->where('r.isFake is NULL'); 
          return $qb->getQuery()->getResult();
  }

   public function findNotSendDesc($registrationIds=array()){
         $qb = $this->createQueryBuilder('r')
        -> where('a.registrationId not IN (:registrationIds)')->setParameter('registrationIds', $registrationIds)
        ->andWhere('r.isFake is NULL'); 
          return $qb->getQuery()->getResult();
  } 
}
