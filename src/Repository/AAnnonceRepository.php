<?php

namespace App\Repository;

use App\Entity\AAnnonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AAnnonce>
 *
 * @method AAnnonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method AAnnonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method AAnnonce[]    findAll()
 * @method AAnnonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AAnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AAnnonce::class);
    }

    public function save(AAnnonce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AAnnonce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findByParam($searchVille,$searchType,$searchChambres,$searchPrixMax,$searchSurfaceMin)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->leftJoin('p.acategory', 'c');
        $qb->andWhere(
                    $qb->expr()->andX(
                        $qb->expr()->like('p.aville', ':searchVille'),
                        $qb->expr()->lte('p.aprix', ':searchPrixMax'),
                        $qb->expr()->like('c.catnom', ':searchType'),
                        $qb->expr()->gte('p.bedrooms', ':searchChambres'),
                        $qb->expr()->gte('p.Surface', ':searchSurfaceMin')  
                    )
        )
            ->setParameter('searchVille', '%' . $searchVille . '%')
            ->setParameter('searchPrixMax',$searchPrixMax)
            ->setParameter('searchSurfaceMin',$searchSurfaceMin)
            ->setParameter('searchChambres',$searchChambres)
            ->setParameter('searchType', '%' . $searchType . '%')
            ->orderBy('p.aville', 'ASC');
        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return AAnnonce[] Returns an array of AAnnonce objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AAnnonce
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
