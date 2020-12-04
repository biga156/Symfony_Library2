<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\ORM\Query;
use App\Entity\Rechercher;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }


    //fonction pour trouver un livre à partir d'un titre, d'un auteur ou de sa cote
    public function findLivre($title, $authtor, $cote)
    {
        return $this->createQueryBuilder('Livre')
            ->andWhere('Livre.title LIKE :title')
            ->setParameter('title', '%' . $title . '%')
            ->andWhere('Livre.authtor LIKE :authtor')
            ->setParameter('authtor', '%' . $authtor . '%')
            ->andWhere('Livre.cote LIKE :cote')
            ->setParameter('cote', '%' . $cote . '%')
            ->getQuery()
            ->execute();
    }





    // /**
    //  * @return Livre[] Returns an array of Livre objects
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
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
