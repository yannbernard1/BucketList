<?php

namespace App\Repository;

use App\Entity\Animaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Animaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animaux[]    findAll()
 * @method Animaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animaux::class);
    }

    public function findRaceVegetarienne($race) {

        $em = $this->getEntityManager();
        $dql = "SELECT a FROM App\Entity\Animaux a
        WHERE a.race = :race
        AND a.isCarnivore = false
        ";
        $requete = $em->createQuery($dql)->setParameter('race', $race);
        return $requete->getResult();
    }

    public function findRaceVegetarienneAvecQB($race) {

        $qb = $this->createQueryBuilder('a');
        $qb
            ->andWhere('a.race = :race')
            ->andWhere('a.isCarnivore = false')
            ->setParameter('race', $race)
        ;

        $requete = $qb->getQuery();
        return $requete->execute();

    }

    // /**
    //  * @return Animaux[] Returns an array of Animaux objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Animaux
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
