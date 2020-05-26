<?php

namespace App\Repositories\Api\Placeholder;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

/**
 * Class User
 *
 * @package App\Repositories\Api\Placeholder
 */
class User extends Base implements Repository
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        $httpClient = new Client();

        $url = config('apis.placeholder.urls.production') . '/users';

        $response = $httpClient->get($url);

        $responseBody = $this->extractResponseBody($response);
        $responseArray = $this->decodeResponse($responseBody);

        $this->logApiCall($url, 'get', $responseBody, $response->getStatusCode());

        return collect($responseArray);
    }
}
