<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 05.12.2018
 * Time: 21:14
 */

namespace App\Service;

use App\Controller\MessageInterface;
use App\Entity\EventRequest;
use Doctrine\ORM\EntityManagerInterface;

class LogCompression implements MessageInterface
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
     * Compress text fields of event
     * @param EventRequest $eventRequest
     * @return EventRequest
     */
    public function compressEventLogData (EventRequest $eventRequest) : EventRequest
    {
        $request = $eventRequest->getRequest();
        $eventRequest->setRequest(gzcompress ($request));

        $response = $eventRequest->getResponse();
        $eventRequest->setResponse(gzcompress ($response));

        $eventRequest->setNote(self::MESSAGE_COMPRESSED);

        $this->em->persist($eventRequest);
        $this->em->flush();

        return $eventRequest;
    }
}