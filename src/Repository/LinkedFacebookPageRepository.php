<?php

namespace App\Repository;

use App\Entity\LinkedFacebookPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LinkedFacebookPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkedFacebookPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkedFacebookPage[]    findAll()
 * @method LinkedFacebookPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkedFacebookPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkedFacebookPage::class);
    }

    // /**
    //  * @return LinkedFacebookPage[] Returns an array of LinkedFacebookPage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LinkedFacebookPage
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
