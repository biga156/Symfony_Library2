<?php

namespace App\Repository;

use App\Entity\CDRom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CDRom|null find($id, $lockMode = null, $lockVersion = null)
 * @method CDRom|null findOneBy(array $criteria, array $orderBy = null)
 * @method CDRom[]    findAll()
 * @method CDRom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CDRomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CDRom::class);
    }

    // /**
    //  * @return CDRom[] Returns an array of CDRom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CDRom
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
