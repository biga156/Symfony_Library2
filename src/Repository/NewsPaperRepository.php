<?php

namespace App\Repository;

use App\Entity\NewsPaper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewsPaper|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsPaper|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsPaper[]    findAll()
 * @method NewsPaper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsPaperRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsPaper::class);
    }


      //fonction pour trouver un journal à partir d'un titre ou de sa cote
      public function findNewspaper($title, $cote)
      {
          return $this->createQueryBuilder('NewsPaper')
              ->andWhere('NewsPaper.title LIKE :title')
              ->andWhere('NewsPaper.cote LIKE :cote')
              ->setParameter('title', '%' . $title . '%')
              ->setParameter('cote', '%' . $cote . '%')
              ->getQuery()
              ->execute();
      }
  

    // /**
    //  * @return NewsPaper[] Returns an array of NewsPaper objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewsPaper
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
