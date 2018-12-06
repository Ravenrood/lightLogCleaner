<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 06.12.2018
 * Time: 19:00
 */

namespace App\Service;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;


class SearchOldEvents
{
    protected $em;

    /**
     * SearchOldEvents constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Get events from db
     * @param DateTime $date
     * @return mixed
     */
    public function getOldEvents (DateTime $date )
    {
        return $result = $this->em
            ->getRepository('App:EventLog')
            ->findByEventStartDate($date);
    }
}