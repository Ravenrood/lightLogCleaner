<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 05.12.2018
 * Time: 20:36
 */

namespace App\Controller;

use App\Service\AddEventLog;
use App\Service\FormatJsonResponse;
use App\Service\LogCompression;
use App\Service\UpdateEventLog;
use Symfony\Component\HttpFoundation\Request;
use App\Service\StateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\SearchOldEvents;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogCleanerController extends AbstractController implements MessageInterface, StateInterface
{

    /**
     * @Route("/")
     * @param Request $request
     * @param FormatJsonResponse $jsonResponse
     * @param AddEventLog $addEventLog
     * @param UpdateEventLog $updateEventLog
     * @param SearchOldEvents $searchOldEvents
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function clearOldLog(Request $request, LogCompression $logCompression, FormatJsonResponse $jsonResponse, AddEventLog $addEventLog, UpdateEventLog $updateEventLog, SearchOldEvents $searchOldEvents) : JsonResponse
    {
        $eventLog = $addEventLog->addNewEvent($request);
        $oldDate = new DateTime();
        $oldDate->modify('-1 day');
        $oldEvents = $searchOldEvents->getOldEvents($oldDate);
        if (empty($oldEvents)) {
            return $jsonResponse->formatResponse(200,true,self::MESSAGE_DONE);
        }
        foreach ($oldEvents as $event) {
            $eventCollection = $event->getEventRequest()->toArray();
            foreach ($eventCollection as $eventLog) {
                $updatedEventLog = $logCompression->compressEventLogData($eventLog);
            }
            $event->setNote(self::MESSAGE_COMPRESSED);
            $updateEventLog->updateEventLog($event);
        }
        return $jsonResponse->formatResponse(200,true,self::MESSAGE_DONE);
    }
}