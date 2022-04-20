<?php

namespace App\Repository;

use App\Entity\HomepageSlider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HomepageSlider|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomepageSlider|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomepageSlider[]    findAll()
 * @method HomepageSlider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomepageSliderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomepageSlider::class);
    }

    // /**
    //  * @return HomepageSlider[] Returns an array of HomepageSlider objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HomepageSlider
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
