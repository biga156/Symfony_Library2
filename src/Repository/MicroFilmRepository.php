<?php

namespace App\Repository;

use App\Entity\MicroFilm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MicroFilm|null find($id, $lockMode = null, $lockVersion = null)
 * @method MicroFilm|null findOneBy(array $criteria, array $orderBy = null)
 * @method MicroFilm[]    findAll()
 * @method MicroFilm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MicroFilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MicroFilm::class);
    }

    // /**
    //  * @return MicroFilm[] Returns an array of MicroFilm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MicroFilm
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
