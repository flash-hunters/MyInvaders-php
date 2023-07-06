<?php

namespace App\Repository;

use App\Entity\SpaceInvader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SpaceInvader>
 *
 * @method SpaceInvader|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceInvader|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceInvader[]    findAll()
 * @method SpaceInvader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceInvaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceInvader::class);
    }

    public function save(SpaceInvader $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SpaceInvader $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SpaceInvader[] Returns an array of SpaceInvader objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SpaceInvader
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
