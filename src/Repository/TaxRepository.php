<?php

namespace App\Repository;

use App\Entity\Tax;
use App\Enum\GeoCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tax>
 */
class TaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tax::class);
    }

    public function insert(Tax $tax): void
    {
        $this->getEntityManager()->persist($tax);
        $this->getEntityManager()->flush();
    }

    /** @param Tax[] $taxes */
    public function insertBatch(array $taxes)
    {
        $em = $this->getEntityManager();
        array_walk($taxes, fn($tax) => $em->persist($tax));
        $em->flush();
    }

    public function findOneByGeoCode(GeoCode $code): ?Tax
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.geo_code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return Tax[] Returns an array of Tax objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }
    //    public function findOneBySomeField($value): ?Tax
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
