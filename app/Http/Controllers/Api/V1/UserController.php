<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PlaceholderUser;
use App\Queries\Api\V1\User\Index;
use App\Queries\Api\V1\User\Show;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Api\V1
 */
class UserController extends Controller
{
    /**
     * @param Index $query
     *
     * @return JsonResponse
     */
    public function index(Index $query): JsonResponse
    {
        $data = $query->getData();
        return response()->json($data);
    }

    public function show(PlaceholderUser $placeholderUser, Show $query): JsonResponse
    {
        $data = $query->getData($placeholderUser);
        return response()->json($data);
    }
}
