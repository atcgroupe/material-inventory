<?php

namespace App\Repository;

use App\Entity\Material;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Material|null find($id, $lockMode = null, $lockVersion = null)
 * @method Material|null findOneBy(array $criteria, array $orderBy = null)
 * @method Material[]    findAll()
 * @method Material[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Material::class);
    }

    /**
     * @return Material[] Returns an array of Material objects
     */
    public function findByName(string|null $search)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.name LIKE :val')
                ->setParameter('val', '%' . strtolower($search) . '%')
            ->andWhere('m.isActive = :isActive')
                ->setParameter('isActive', true)
            ->orderBy('m.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function isUnique(array $search)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('LOWER(m.name) = LOWER(:name)')
            ->setParameter('name', $search['name'])
            ->getQuery()
            ->getResult()
        ;
    }

    public function findWithRelations(int $id): ?Material
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id = :id')
            ->setParameter('id', $id)
            ->addSelect('formats')
                ->leftJoin('m.formats', 'formats')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
