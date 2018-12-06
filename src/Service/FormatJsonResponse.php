<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 06.12.2018
 * Time: 06:47
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

class FormatJsonResponse
{
    /**
     * Format Json Response
     * @param int $statusCode
     * @param bool $status
     * @param string $message
     * @param array $additionalData
     * @return JsonResponse
     */
    function formatResponse (int $statusCode, bool $status, string $message, array $additionalData = []): JsonResponse {
        $response = new JsonResponse();
        $response->setStatusCode($statusCode);
        $response->setContent(
            json_encode(array(
            'status' => $status,
            'message' => $message,
            'extraData' => $additionalData
        )));
        return $response;
    }
}