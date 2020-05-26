<?php

namespace App\Repositories\Api\Placeholder;

use App\Models\ApiCall;
use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Base
 *
 * @package App\Repositories\Api\Placeholder
 */
class Base
{
    /**
     * @param ResponseInterface $response
     *
     * @return string|null
     */
    protected function extractResponseBody(ResponseInterface $response): ?string
    {
        if (!$response->getBody()) {
            return null;
        }

        return (string)$response->getBody();
    }

    /**
     * @param string $responseBody
     *
     * @return array
     */
    protected function decodeResponse(string $responseBody): array
    {
        $responseArray = json_decode($responseBody, true);

        if (!is_array($responseArray)) {
            return [];
        }

        return $responseArray;
    }

    /**
     * @param string $url
     * @param string $method
     * @param string $response
     * @param string $statusCode
     */
    protected function logApiCall(string $url, string $method, string $response, string $statusCode): void
    {
        ApiCall::create([
            'url' => $url,
            'method' => $method,
            'response' => $response,
            'status_code' => $statusCode,
            'sent_at' => Carbon::now(),
        ]);
    }
}
