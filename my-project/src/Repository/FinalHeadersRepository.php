<?php

namespace App\Repository;

use App\Entity\FinalHeaders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FinalHeaders>
 *
 * @method FinalHeaders|null find($id, $lockMode = null, $lockVersion = null)
 * @method FinalHeaders|null findOneBy(array $criteria, array $orderBy = null)
 * @method FinalHeaders[]    findAll()
 * @method FinalHeaders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinalHeadersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FinalHeaders::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(FinalHeaders $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(FinalHeaders $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return FinalHeaders[] Returns an array of FinalHeaders objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FinalHeaders
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
