<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 05.12.2018
 * Time: 19:54
 */

namespace App\Service;

use App\Entity\EventLog;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class AddEventLog implements StateInterface
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Save New Event
     * @param Request $request
     * @return EventLog
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addNewEvent(Request $request): eventLog {
        $eventLog = new EventLog();
        $event = $request->getPathInfo();
        $eventStartDate = new DateTime();
        $eventEndDate = new DateTime();

        $eventStartDate->setTimestamp($request->server->get('REQUEST_TIME'));
        $eventEndDate->setTimestamp($request->server->get('REQUEST_TIME'));

        $eventLog->setEvent($event);
        $eventLog->setEventStartDate($eventStartDate);
        $eventLog->setEventEndDate($eventEndDate);
        $eventLog->setNote("");

        $state = $this->em->getReference('App\Entity\State', self::STATE_RECEIVED);
        $eventLog->setState($state);

        $this->em->persist($eventLog);
        $this->em->flush();

        return $eventLog;
    }
}
