<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    /**
     * @return Reservation[] Returns an array of Reservation objects
     */
    public function searchByName(bool $creation, string|null $search)
    {
        $queryBuilder = $this->createQueryBuilder('r');
        return $queryBuilder
            ->add('where', $queryBuilder->expr()->andX(
                ($creation) ? $queryBuilder->expr()->neq('r.status', 1) : null,
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->like('LOWER(r.jobId)', ':search'),
                    $queryBuilder->expr()->like('LOWER(r.jobCustomer)', ':search')
                )
            ))
            ->setParameter('search', '%' . $search . '%')
            ->orderBy('r.deliveryDate', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
