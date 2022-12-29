<?php

namespace App\Repository;

use App\Entity\Place;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Place>
 *
 * @method Place|null find($id, $lockMode = null, $lockVersion = null)
 * @method Place|null findOneBy(array $criteria, array $orderBy = null)
 * @method Place[]    findAll()
 * @method Place[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Place::class);
    }

    public function save(Place $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Place $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Place[]
     */
    public function findByPlaceAndPackage(?string $placeTitle, ?string $packageTitle, ?int $page = 1, ?int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.package', 'pk')
            ->addSelect('pk');

        if ($this->isValidFilter($placeTitle)) {
            $qb->Where('p.title LIKE :p_title')
                ->setParameter('p_title', sprintf('%%%s%%', $placeTitle))
                ->addOrderBy('p.title', 'ASC');
        }
        if ($this->isValidFilter($packageTitle)) {
            $qb
                ->andWhere('pk.title LIKE :pk_title')
                ->setParameter('pk_title', sprintf('%%%s%%', $packageTitle))
                ->addOrderBy('pk.title', 'ASC');
        }

        return $qb
            ->setMaxResults($limit)
            ->setFirstResult(($page - 1) * $limit)
            ->getQuery()
            ->getResult();

    }

    public function countPages(?string $placeTitle, ?string $packageTitle, ?int $limit = 10): int
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.package', 'pk')
            ->select('count(p)');

        if ($this->isValidFilter($placeTitle)) {
            $qb->Where('p.title LIKE :p_title')
                ->setParameter('p_title', sprintf('%%%s%%', $placeTitle))
                ->addOrderBy('p.title', 'ASC');
        }
        if ($this->isValidFilter($packageTitle)) {
            $qb
                ->andWhere('pk.title LIKE :pk_title')
                ->setParameter('pk_title', sprintf('%%%s%%', $packageTitle))
                ->addOrderBy('pk.title', 'ASC');
        }

        return ceil($qb->getQuery()->getOneOrNullResult()[1] / $limit);
    }

    private function isValidFilter(?string $value): bool
    {
        return $value !== null && strlen($value) >1 ;
    }

//    /**
//     * @return Place[] Returns an array of Place objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Place
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
