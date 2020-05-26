<?php

namespace App\Repositories\Api\Placeholder;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

/**
 * Class Comment
 *
 * @package App\Repositories\Api\Placeholder
 */
class Comment extends Base implements Repository
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        $httpClient = new Client();

        $url = config('apis.placeholder.urls.production') . '/comments';

        $response = $httpClient->get($url);

        $responseBody = $this->extractResponseBody($response);
        $responseArray = $this->decodeResponse($responseBody);

        $this->logApiCall($url, 'get', $responseBody, $response->getStatusCode());

        return collect($responseArray);

    }
}
