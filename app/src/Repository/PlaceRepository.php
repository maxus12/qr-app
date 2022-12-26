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
     * @param string|null $placeTitle
     * @param string|null $packageTitle
     * @param int|null $page
     * @param int|null $limit
     * @return Place[]
     */
    public function findByPlaceAndPackage(?string $placeTitle, ?string $packageTitle, ?int $page = 1, ?int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('pl');
        if ($this->isValidFilter($placeTitle)) {
            $qb->andWhere('pl.title LIKE :title')->setParameter('title', sprintf('\%%s\%', $placeTitle));
        }
        if ($this->isValidFilter($packageTitle)) {
            $qb->leftJoin('p.package', 'p')->andWhere('p.title LIKE :title')->setParameter('title', sprintf('\%%s\%', $packageTitle));
        }

        return $qb
            ->addOrderBy('pl.title', 'ASC')
            ->setMaxResults($limit)
            ->setFirstResult(($page - 1) * $limit)
            ->getQuery()
            ->getResult();
    }

    private function isValidFilter(?string $value): bool
    {
        return $value !== null && strlen($value) > 2 ;
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
