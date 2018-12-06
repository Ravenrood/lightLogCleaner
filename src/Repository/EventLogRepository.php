<?php

namespace App\Repository;

use App\Entity\EventLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use DateTime;

/**
 * @method EventLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventLog[]    findAll()
 * @method EventLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventLogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EventLog::class);
    }

    /**
     * @param DateTime $date
     * @return mixed
     */
    public function findByEventStartDate(DateTime $date)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.event_start_date <= :val')
            ->setParameter('val', $date)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
}
