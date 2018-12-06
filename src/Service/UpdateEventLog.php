<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 05.12.2018
 * Time: 20:01
 */

namespace App\Service;

use App\Entity\EventLog;
use Doctrine\ORM\EntityManagerInterface;

class UpdateEventLog implements StateInterface
{
    protected $em;

    /**
     * UpdateEventLog constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * update event in DB
     * @param EventLog $eventLog
     * @return EventLog
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateEventLog (EventLog $eventLog): EventLog {

        $this->em->persist($eventLog);
        $this->em->flush();

        return $eventLog;
    }

}
