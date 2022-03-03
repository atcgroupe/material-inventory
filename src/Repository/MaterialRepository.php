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
            ->andWhere('LOWER(m.name) LIKE LOWER(:val)')
                ->setParameter('val', '%' . $search . '%')
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
}
