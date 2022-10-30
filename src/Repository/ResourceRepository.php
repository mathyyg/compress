<?php

namespace App\Repository;

use App\Entity\Resource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Resource>
 *
 * @method Resource|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resource|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resource[]    findAll()
 * @method Resource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resource::class);
    }

    public function save(Resource $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Resource $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByUrl($url) {
        return $this->createQueryBuilder('r')
            ->andWhere('r.url = :val')
            ->setParameter('val', $url)
            ->getQuery()
            ->getResult();
    }

    public function checkAccess($resource, $user) {
        if($user == null) {
            return false;
        }
        if($resource->getUser()->getId() == $user->getId()) {
            return true;
        }
        else {
            return false;
        }
    }

    public function findByUserAndFilter($value,$filters): array
    {

        $qb = $this->createQueryBuilder('r')
            ->Where('r.user = :val')
            ->setParameter('val', $value);

            if (array_key_exists('type', $filters)
            && $filters['type'] !== ''){
                $qb->andWhere('r.type = :type')
                ->setParameter('type', $filters['type']);
            }
            if (array_key_exists('url', $filters)
            && $filters['url'] !== ''){
                $qb->andwhere('r.url LIKE :url')
                   ->setParameter('url', '%'.$filters['url'].'%');
            }

            return $qb->getQuery()->getResult();
        ;
    }

}
